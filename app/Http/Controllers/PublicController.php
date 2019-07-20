<?php

namespace App\Http\Controllers;

use App\Post;
use Mail;
use App\Mail\ContactUs;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * function that will route the home page
     * @return type view
     */
    public function index()
    {
        $posts = Post::paginate(4);
        return view('welcome', compact('posts'));
    }
    
    public function singlePost(Post $posts)
    {
        return view('singlePost', compact('posts'));
    }
    
    public function about()
    {
        return view('about');
    }
    
    public function contact()
    {
        return view('contact');
    }
    
    public function termsAndConditions()
    {
        return view('termsAndConditions');
    }


    
    
    /**
     * Method send email to the webmaster of the website
     * @param Request $request
     * @return type
     */
    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z-,.!? ]*$/',
            'email' => 'required|email',
            'contact_number' => 'required|string|regex:/^[a-zA-Z0-9+,.!? ]*$/',
            'content' => 'required|string'
        ]);
        
        $name = $request['name'];
        $email = $request['email'];
        $contact_number = $request['contact_number'];
        $content = $request['content'];
        
        try 
        {
            //send the receipt email to the client using the $paymentInfo data
            Mail::to('webmaster@tiandlily.com')->send(new ContactUs($name, $email, $contact_number, $content));
            return redirect(route('messageSent'));
        } 
        catch (Exception $ex)
        {
                return redirect(route('errorPage'));
        }
    }
    
    
    public function messageSent()
    {
        return view('messageSent');    
    }
    
    
    public function errorPage()
    {
        return view('errorPage');
    }
}
