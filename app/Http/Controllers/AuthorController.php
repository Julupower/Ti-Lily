<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use App\Http\Requests\CreatePost;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    //class constructor will check if the user is logged in as an author role
    //or a normal user role
    public function __construct()
    {
        
        $this->middleware('checkRole:author');
//        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        //get an array of ID's of comments from a post using the pluck() function 
        //and putting the collection returned into an array
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        
        //get the total number of comments from a post
        $totalComments = Comment::whereIn('post_id', $posts)->get();
        
        //get only the all comments of a post from todays date
        $todaysComments = $totalComments->where('created_at', '>=', Carbon::today());
        
        //create a chart object
        $chart = new DashboardChart;
        //create a variable of day dates with the start date being 30 days ago
        //and the end send date being todays date now.
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        //create an array variable that will hold the number of comments made in the last 30 days
        $arrayOfPosts = [];
        
        foreach($days as $day)
        {
            //get the count tally of comments made by this user_id
            $arrayOfPosts[] = Post::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }
        
        //create a chart dataset with the name 'Posts' and the type will = 'line'
        $chart->dataset('Posts', 'line', $arrayOfPosts);
        //give the dataset a label of days
        $chart->labels($days);

        
        return view('author.dashboard', compact('totalComments', 'todaysComments', 'chart'));
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
    
    
    public function createNewPost(CreatePost $request)
    {
        //create a post object
        $post = new Post();
        
        //initialize the post with data from the form
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->user_id = Auth::id();
        $post->save();
        
        //resubmit the page with success message
        return back()->with('success', 'A New Post Has Successfully Been Created ?');
    }
    
    
    public function editPost($id)
    {
        //create a post variable theat will be use '$id' to see if the user has 
        //permission to edit the post
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        return view('author.editPost', compact('post'));
    }
    
    
    public function postEditPost(CreatePost $request, $id)
    {
        //find the selected post
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        
        //set the title and content of the post to the one in the form from the
        //editPost page
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();
        
        //resubmit the page with success message
        return back()->with('success', "Your post edit has been successfully updated.");
    }
    
    public function deletePost($id)
    {
        //select the requested post by id
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        //delete the post
        $post->delete();
        //resubmit the page
        return back();
    }
    
    
    public function newPost()
    {
        return view('author.newPost');
    }
    
    public function post()
    {
        
        return view('author.post');
    }
    
    public function comments()
    {
        //get an array of post IDs using the pluck() function to extract only 
        //the values from the 'id' coloumn then put them into an array using the
        //toArray() function.
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        //check the post 'id' column against the array of post get all the 
        //comments that match the post_id and pass them to the view as an array
        $comments = Comment::whereIn('post_id', $posts)->get();
        return view('author.comments', compact('comments'));
    }
}
