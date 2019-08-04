<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdate;
use App\Http\Requests\CreatePost;
use App\Http\Requests\CreateProduct;
use App\Http\Requests\EditProduct;
use App\Http\Requests\ValidateGalleryPostRequest;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use App\Comment;
use App\Post;
use App\User;
use App\Product;
use App\Gallery;

class AdminController extends Controller
{
    //class constructor checks if the user is logged in as admin role or normal
    //user role
    public function __construct()
    {
        
        $this->middleware('checkRole:admin');
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        //create a chart object
        $chart = new DashboardChart;
        //create a variable of day dates with the start date being 30 days ago
        //and the end send date being todays date now.
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        //create an array variable that will hold the number of comments made in the last 30 days
        $arrayOfPosts = [];
        
        foreach($days as $day)
        {
            //get the count tally of comments made by all authors 
            $arrayOfPosts[] = Post::whereDate('created_at', $day)->count();
        }
        
        //create a chart dataset with the name 'Posts' and the type will = 'line'
        $chart->dataset('Posts', 'line', $arrayOfPosts);
        //give the dataset a label of days
        $chart->labels($days);
        
        //return dashboard view and pass the chart variable to the view
        return view('admin.dashboard', compact('chart'));
    }
    
    /**
     * Private inner function used by this controller to generate formatted dates
     * @param Carbon $start_date
     * @param Carbon $send_date
     * @return type
     */
    private function generateDateRange(Carbon $start_date, Carbon $send_date)
    {
        //create an array of dates
        $dates = [];
        
        for($date = $start_date; $date->lte($send_date); $date->addDay())
        {
            $dates[] = $date->format('Y-m-d');
        }
        
        return $dates;
    }
    
    
    public function post()
    {
        $posts = Post::all();
        return view('admin.post', compact('posts'));
    }
    
    public function comments()
    {
        //get all the comments from the Comment modol and pass it to the variabe 
        //that will be passed to the comments view
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }
    
    
    public function deleteComment($id)
    {
        //get the first comment from the post that matches the id
        $comment = Comment::where('id', $id)->first();
        //delete the comment from the database
        $comment->delete();
        //resubmit the page
        return back();
    }
    
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    
    
    public function editUser($id)
    {
        //get the user whos user id matched the ID
        $user = User::where('id', $id)->first();
        //return the view for editing the users and pass the user variable to the view
        return view('admin.editUser', compact('user'));
    }
    
    
    /**
     * Method for updating a user
     * @param UserUpdate $request
     * @param type $id
     * @return type
     */
    function postEditUser(UserUpdate $request, $id)
    {
        //create a variable that will select a user by id then store all the
        //selected user's data
        $user = User::where('id', $id)->first();
        //use the $request object to update the database with data taken from 
        //the form. Update the name, email and if the user has Author and/or 
        //Admin permissions  
        $user->name = $request['name'];
        $user->email = $request['email'];
        //check if the form checkboxes for author and admin permissions are selected
        if($request['author'] == 1)
        {
            //if checkbox is selected update user database permission to author 
            $user->author = true;
        }
        else
            {
                $user->author = false;
            }
        
        if($request['admin'] == 1)
        {
            //if checkbox is selected update user database permission to admin
            $user->admin = true;
        }
        else
            {
                $user->admin = false;
            }
        
        //save the changes in the database
        $user->save();
        //resubmit the page with a success message
        return back()->with('success', "User '{$user->name}' has successfully been updated.");
            
    }
    
    public function deleteUser($id)
    {
        //get the user with the matching user id number
        $user = User::where('id', $id)->first();
        //delete that user from the database
        $user->delete();
        //resubmit the page 
        return back();
        
    }
    
    /**
     * Method that returns the view for editing a post of selected user id
     * @param type $id
     * @return type
     */
    public function editPost($id)
    {
        //get the first post that matches the users id
        $post = Post::where('id', $id)->first();
        //return the admin edit post view and pass the post variable to it. 
        return view('admin.editPost', compact('post'));
    }
    
    /**
     * Method for updating an edited post
     * @param CreatePost $request
     * @param type $id
     * @return type
     */
    public function postEditPost(CreatePost $request, $id)
    {
        //get the first post that matches the users id
        $post = Post::where('id', $id)->first();
        //set the post title and content using the data provided 
        //from the form via the request object
        $post->title = $request['title'];
        $post->content = $request['content'];
        //save the changes made to the database
        $post->save();
        //resubmit the page with a success message
        return back()->with('success', "The post has successfully been updated.");
    }
    
    /**
     * Method deletes a post of a selected user id from the database
     * @param type $id
     * @return type
     */
    public function deletePost($id)
    {
        //get the first post that matches the users id
        $post = Post::where('id', $id)->first();
        //delete the post from the database
        $post->delete();
        //resubmit the page
        return back();
    }
    
    /**
     * method that returns the admin listing all the shop products
     * @return type
     */
    public function products()
    {
        //create a prodct variable that will hold all the product data
        
        $products = Product::all();
        //return view and pass the product variable to the view
        return view('admin.products', compact('products'));
    }
    
    
    /**
     * Method that gets a product matching product id then returns the edit product
     * view passing this product object to the view 
     * @param type $id
     * @return type
     */
    public function editProduct($id)
    {
        //get the product with matching product id
        $product = Product::findOrFail($id); 
        //return the view and pass the product variable to the view
        return view('admin.editProduct', compact('product'));
    }
    
    /**
     * Method returns the admin view with the form for creating a new shop product
     * @return type
     */
    public function newProduct()
    {
        return view('admin.newProduct');
    }
    
    
    /**
     * Method that will use the request object to get data from a form and use it
     * to create a new product that will be saved onto the database
     * @param CreateProduct $request
     * @return type
     */
    public function newProductPost(CreateProduct $request)
    {
        //create a new product object
        $product = new Product;
        //use set the attributes of the product object using the data  from the 
        //form via the validated request object
        $product->title = $request['product-name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        
        //move the uploaded image to the required directory
        $thumbnail = $request->file('thumbnail');
        $fileName = $thumbnail->getClientOriginalName();//get the file path of the image 
//        $fileExtension = $thumbnail->getClientOriginalExtension();//get the file type of the image
        $thumbnail->move('product_images', $fileName);//move the file to the required directory
        
        //put the file path and file name of the image on the database thumbnail field
        $product->thumbnail = 'product_images/' .$fileName;
        
        //save the new product to the database
        $product->save();
        //resubmit the page with a success message
        return back()->with('success', "A new product has been successfully created");
    }
    
    
    public function editProductPost(EditProduct $request, $id)
    {
        //get the product with matching product id
        $product = Product::findOrFail($id);
        //use set the attributes of the product object using the data  from the 
        //form via the validated request object
        $product->title = $request['product-name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        
        //First use request object to check if the thumbnail has been sent in the form,
        //if so move the uploaded image to the required directory
        If($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');
            $fileName = $thumbnail->getClientOriginalName();//get the file path of the image 
            $thumbnail->move('product_images', $fileName);//move the file to the required directory
        
            //put the file path and file name of the image on the database thumbnail field
            $product->thumbnail = 'product_images/' .$fileName;
        }
  
        //save the new product to the database
        $product->save();
        //resubmit the page with a success message
        return back()->with('success', "Product ''{$product->title}'' has been successfully updated");
        
        
    }
    
    /**
     * Method to delete products from the database
     * @param type $id
     * @return type
     */
    public function deleteProduct($id)
    {
        //get the first product that matches the id
        $product = Product::where('id', $id)->first();
        //delete the product from the database
        if(file_exists($product->thumbnail))
        {
            //remove file from directory
            unlink ($product->thumbnail);   
        }
        
        $product->delete();
        //resubmit the page
        return back()->with('success', "The product was successfully removed");
    }
    
    /**
     * 
     * @return type
     */
    public function editGalleryView()
    {
        $gallery_images = Gallery::orderBy('sort_order')->get();
        $last_image = Gallery::orderBy('sort_order', 'DESC ')->first();
        return view('admin.editGallery', compact('gallery_images', 'last_image'));
    }
    
    
    /**
     * Method that will use the request object to get data from a form and use it
     * to create a new Gallery image
     * @param CreateProduct $request
     * @return type
     */
    public function addGalleryImage(ValidateGalleryPostRequest $request)
    {
        //create a new product object
        $img = new Gallery();
        //use set the attributes of the product object using the data  from the 
        //form via the validated request object
        $img->title = $request['title'];
        $img->description = $request['desc'];
        $img->sort_order = $request['position'];
        
        //move the uploaded image to the required directory
        $image_filepath = $request->file('image');
        $fileName = $image_filepath->getClientOriginalName();//get the file path of the image 
//        $fileExtension = $thumbnail->getClientOriginalExtension();//get the file type of the image
        $image_filepath->move('gallery_images', $fileName);//move the file to the required directory
        
        //put the file path and file name of the image on the database thumbnail field
        $img->image_filepath = 'gallery_images/' .$fileName;
        
        //save the new image to the Gallery database
        $img->save();
        //resubmit the page with a success message
        return back()->with('success', "A new Image has been successfully added to the Gallery");
    }
    
    /**
     * Method that will delete image file from Gallery
     * @param type $id
     * @return type
     */
    public function deleteImg($id)
    {
        //get the first product that matches the id
        $img = Gallery::where('id', $id)->first();
        
        if(file_exists($img->image_filepath))
        {
            //remove file from directory
            unlink ($img->image_filepath);
            //delete the image from the database
            $img->delete();
            //resubmit the page
            return back()->with('success', "Image was seccessfully removed from the Gallerry");
        }
        else{
            return back()->withErrors('ERROR: Gallery Image could not be found in the database');
        }
    }
    
    
}
