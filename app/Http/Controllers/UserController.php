<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdate;
use App\Charts\DashboardChart;
use App\Comment;
use Carbon\Carbon;

class UserController extends Controller
{
    
    /**
     * constructor method that uses middleware to check user access to the controller
     * @return type
     */
    public function __construct()
    {
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
        $comments = [];
        
        foreach($days as $day)
        {
            //get the count tally of comments made by this user_id
            $comments[] = Comment::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }
        
        //create a chart dataset with the name 'Comments' and the type will = 'line'
        $chart->dataset('Comments', 'line', $comments);
        //give the dataset a label of days
        $chart->labels($days);
        
        //return the dashboard template view pass the chart variable to the view
        return view('user.dashboard', compact('chart'));
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
    
    
    public function comments()
    {   
        return view('user.comments');
    }
    
    
    /**
     * Method to delete user comments of a matching user_id
     * @param type $id
     * @return type
     */
    public function deleteComment($id)
    {
        //find the first row of the user comment by id
        //check that the user is the creator of the comment
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->first();
        
        //if comment is found delete the comment
        if($comment)
        {
            $comment->delete();
        }
        //resubmit the page 
        return back();
    }
    
    
    public function newComment(Request $request)
    {
        //create a comment object
        $comment = new Comment;
        //get the data from the form using the request object and use it to create 
        //a new comment
        $comment->post_id = $request['new-comment-post'];
        $comment->user_id = Auth::id();
        $comment->content = $request['new-comment'];
        //save the new comment to the database
        $comment->save(); 
        //resubmit the page
        return back();
    }
    
    
    public function profile()
    {
        return view('user.profile');
    }
    
    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        
        //check is the user password field in the for is empty 
        if($request['password'] != "")
        {
            //check is the user password matches the one in the database
            if(!(Hash::check($request['password'], Auth::user()->password)))
            {
                //resubmit the page with error message stating that the passwords
                //do not match
                return redirect()->back()->with('error', "ERROR: Your current password doesn't match with the password you provided earlier.");
            }
            
            //check if the current password matches the new password
            if(strcmp($request['password'], $request['new_password']) == false)
            {
                //resubmit the profile page with an error message that states
                //that the new password is the same as the old passeord
                return redirect()->back()->with('error', "ERROR: Your new password is the same as the old password. Please change it to something different.");
            }
            
            //add validation for the current password and new password fields in the form
            $validation = $request->validate([
                'password' => 'string|required',
                'new_password' => 'string|required|min:6|confirmed'
            ]);
            
            //if the password passes the validation test then set the new password
            //to the user database table
            $user->password = bcrypt($request['new_password']);
            $user->save();
            
            //resubmit the profile page with a success message
            return redirect()->back()->with('success', "Your new password has been successfully set.");
        }

        return back();
    }
}
