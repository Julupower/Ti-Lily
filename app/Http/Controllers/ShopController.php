<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Facade\PayPal;
use App\Product;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use Exception;
use Mail;
use App\Mail\SendMailPurchase;

class ShopController extends Controller
{
    public function index()
    {
        //create a products variable that will contain the data of an array of products
        $products = Product::all();
        //reteurn the view and pass the array of products variable to the view
        return view('shop.index', compact('products'));
    }
    
    
    /**
     * Method that returns the view that displays all the data about a selected product
     * @param type $id
     * @return type
     */
    public function singleProduct($id)
    {
        //get all the data of the product with a matching product id number
        $product = Product::findOrFail($id);
        //return the view passing the product variable to the view
        return view('shop.singleProduct', compact('product'));
    }
    
    
    /**
     * Method for processing PayPal orders
     * @param type $id
     * @return Payment
     */
    public function orderProduct($id)
    {
        //create a paypal api object
        $apiContext = PayPal::apiContext();
        
        //create a product object that is the product of matching ID number
        $product = Product::findOrFail($id);




        // ### Payer
        // A resource representing a Payer that funds a payment
        // For paypal account payments, set payment method
        // to 'paypal'.
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // ### Itemized information
        // (Optional) Lets you specify item wise
        // information
        $item1 = new Item();
        $item1->setName($product->title)
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setSku($product->id) // Similar to `item_number` in Classic API
            ->setPrice($product->price);
//        $item2 = new Item();
//        $item2->setName('Granola bars')
//            ->setCurrency('GBP')
//            ->setQuantity(5)
//            ->setSku("321321") // Similar to `item_number` in Classic API
//            ->setPrice(2);

        $itemList = new ItemList();
//        $itemList->setItems(array($item1));

        // ### Additional payment details
        // Use this optional field to set additional
        // payment information such as tax, shipping
        // charges etc.
        $details = new Details();
        $details->setShipping(2)
            ->setTax(2)
            ->setSubtotal($product->price);

        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("GBP")
            ->setTotal($product->price +4)
            ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
//        $baseUrl = "http://tiandlily.com";// getBaseUrl()
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('shopExecuteOrder', $id))
            ->setCancelUrl(route('shopIndex'));

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        // For Sample Purposes Only.
        $request = clone $payment;

        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($apiContext);
        } 
        catch (Exception $ex)
        {
            print("Created Payment Using PayPal. Please visit the URL to Approve." .$request);
            exit(1);
        }

        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();
//         print("Created Payment Using PayPal. Please visit the URL to Approve: <a href='{$approvalUrl}' >CLICK URL TO APPROVE PRODUCT</a>");

        return redirect($approvalUrl);
    }
    
    
    public function executeOrder($id)
    {
        //create a paypal api object
        $apiContext = PayPal::apiContext();
        
        //create a product object that is the product of matching ID number
        $product = Product::findOrFail($id);
  
            // Get the payment Object by passing paymentId
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);
            
            
            // ### Payment Execute
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution(); 
            $execution->setPayerId($_GET['PayerID']);
            
            
            $details = new Details();
            $details->setShipping(2);
            $details->setTax(2);
            $details->setSubtotal($product->price);
            
            $amount = new Amount();
            $amount->setCurrency("GBP");
            $amount->setTotal($product->price +4);
            $amount->setDetails($details);
            
            $transaction = new Transaction();
            $transaction->setAmount($amount);
            // Add the above transaction object inside our Execution object.
            $execution->addTransaction($transaction);
            try {
                // Execute the payment
                // (See bootstrap.php for more on `ApiContext`)
                $result = $payment->execute($execution, $apiContext);
                print("<h1>SUCCESS--Executed Payment 1</h1> <br><br><h2>Details</h2><br><br><strong>Payment ID Number:</strong> " .$payment->getId() ."<br><br><strong>Results:</strong> " .$result);
                try {
                    $payment2 = Payment::get($paymentId, $apiContext);
                    
                    //get all the dayment info data
                    $paymentInfo = json_decode($payment2);
                    
                    //send the receipt email to the client using the $paymentInfo data
                    Mail::to($paymentInfo->payer->payer_info->email)
                            ->bcc('webshop-admin@tiandlily.com')
                            ->send(new SendMailPurchase($paymentInfo));
                    
//                    dump($paymentInfo); die;
                    
                } 
                catch (Exception $ex)
                {
                    return redirect(route('shopIndex'));
                }
            } 
            catch (Exception $ex)
            {
                return redirect(route('shopIndex'));
            }
            return redirect(route('shopIndex'));
    }
}
