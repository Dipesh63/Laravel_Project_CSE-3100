<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Depttype;
use App\Models\Event;
use App\Models\EventApplication;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\DB;




class HomeController extends Controller
{
    // public function index(){
    //     return view('front.home');
    // }
    public function index() {

        $categories = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();

        //$newCategories = Category::where('status',1)->orderBy('name','ASC')->get();

        // $featuredJobs = Job::where('status',1)
        //                 ->orderBy('created_at','DESC')
        //                 ->with('jobType')
        //                 ->where('isFeatured',1)->take(6)->get();

        $latestevents = Event::where('status',1)
                        
                        ->orderBy('created_at','DESC')
                        ->take(6)->get();



        return view('front.home',[
            'categories' => $categories,
           
            'latestevents' => $latestevents,
            
        ]);
    }




















    public function register(){
        return view('front.layouts.registration');
    }
























    public function login(){
        return view('front.layouts.login');
    }


















    // This method will save a user
    public function processRegistration(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            
            $user->save();

            session()->flash('success','You have registerd successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

















    public function authenticateUser(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error','Either Email/Password is incorrect');
            }

        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

    }








    public function loadProfilePage(){
        $id = Auth::user()->id;

        $user = User::where('id',$id)->first();

        return view('front.layouts.profile',[
            'user' => $user
        ]);

        //return view('front.layouts.profile');

        
    }







    public function logoutfunc(){
        Auth::logout();
        return redirect()->route('account.login');
    }







    
    public function UpdateProfile(Request $request) {

        //dd($request->all());

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);


        if ($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success','Profile updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }




    public function UpdateProfilePic(Request $request){
        
    
        //dd($request->all());

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'image' => 'required|image'
        ]);

        if ($validator->passes()) {

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext;
            $image->move(public_path('/profile_pic/'), $imageName);


            // Create a small thumbnail
            $sourcePath = public_path('/profile_pic/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

            // Delete Old Profile Pic
            File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
            File::delete(public_path('/profile_pic/'.Auth::user()->image));

            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('success','Profile picture updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


















    // public function create_event()
    // {
    //     $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
    //     $deptTypes = Depttype::orderBy('name', 'ASC')->where('status', 1)->get();
    //     $locations = Location::orderBy('name', 'ASC')->where('status', 1)->get();
    
    //     return view('front.layouts.Event.create_event', [
    //         'categories' => $categories,
    //         'deptTypes' => $deptTypes,
    //         'locations' => $locations
    //     ]);
    // }





    public function create_event()
{
    $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
    $deptTypes = Depttype::orderBy('name', 'ASC')->where('status', 1)->get();
    $locations = Location::orderBy('name', 'ASC')->where('status', 1)->get();

    return view('front.layouts.Event.create_event', [
        'categories' => $categories,
        'deptTypes' => $deptTypes,
        'locations' => $locations
    ]);
}





// public function store(Request $request)
// {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'category' => 'required|exists:categories,id',
//         'DeptType' => 'required|exists:depttypes,id',
//         'vacancy' => 'required|integer|min:1',
//         'location' => 'required|exists:locations,id',
//         'description' => 'required|string',
//         'duration' => 'required|string',
//         'club_name' => 'required|string|max:255',
//     ]);

//     $event = new Event();
//     $event->title = $request->title;
//     $event->category_id = $request->category;
//     $event->dept_type_id = $request->DeptType;
//     $event->user_id=Auth::user()->id;
//     $event->vacancy = $request->vacancy;
//     $event->registrationfees = $request->registrationfees;
//     $event->location_id = $request->location;
//     $event->description = $request->description;
//     $event->benefits = $request->benefits;
//     $event->responsibility = $request->responsibility;
//     $event->qualifications = $request->qualifications;
//     $event->keywords = $request->keywords;
//     $event->duration = $request->duration;
//     $event->club_name = $request->club_name;
//     $event->club_location = $request->club_location;
//     $event->club_website = $request->website;
//     $event->save();

//    // return response()->json(['status' => true]);
//    return response()->json(['status' => true, 'redirect' => route('account.profile')]);
   
// }

public function store(Request $request) {

    $rules = [
        'title' => 'required|string|max:255',
        'category' => 'required|exists:categories,id',
        'DeptType' => 'required|exists:depttypes,id',
        'vacancy' => 'required|integer|min:1',
        'location' => 'required|exists:locations,id',
        'description' => 'required|string',
        'duration' => 'required|string',
        'club_name' => 'required|string|max:255',         

    ];

    $validator = Validator::make($request->all(),$rules);

    if ($validator->passes()) {

        $event = new Event();
    $event->title = $request->title;
    $event->category_id = $request->category;
    $event->dept_type_id = $request->DeptType;
    $event->user_id=Auth::user()->id;
    $event->vacancy = $request->vacancy;
    $event->registrationfees = $request->registrationfees;
    $event->location_id = $request->location;
    $event->description = $request->description;
    $event->benefits = $request->benefits;
    $event->responsibility = $request->responsibility;
    $event->qualifications = $request->qualifications;
    $event->keywords = $request->keywords;
    $event->duration = $request->duration;
    $event->club_name = $request->club_name;
    $event->club_location = $request->club_location;
    $event->club_website = $request->website;
    $event->save();

        session()->flash('success','Event added successfully.');

        return response()->json([
            'status' => true,
            'errors' => []
        ]);

    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }


}































public function myevents() {
    $events = Event::where('user_id', Auth::id())->paginate(10);
    return view('front.layouts.Event.myevent', [
        'events' => $events
    ]);
}










// public function show_eventDetail($id)
// {
//     $events= Event::where(['id'=>$id,'status'=>1])->with(['depttype','category','location'])->first();
//     return view('front.layouts.Event.eventDetail',['events'=>$events]);
// }

public function show_eventDetail($id)
{


    $events= Event::where(['id'=>$id,'status'=>1])->with(['depttype','category','location'])->first();
   

   // Retrieve the applications with user information
   $applications = EventApplication::where('event_id', $id)
   ->with('admittedUser') // Include the admittedUser relationship
   ->get();

// Debugging output
 //dd($applications);



    return view('front.layouts.Event.eventDetail',['events'=>$events,'applications'=>$applications]);
}













public function deleteJob($id) {
    $event = Event::where([
        'user_id' => Auth::id(),
        'id' => $id
    ])->first();

    if (!$event) {
        return redirect()->route('event.myevents')->with('error', 'Either event deleted or not found.');
    }

    $event->delete();
    return redirect()->route('event.myevents')->with('success', 'Event deleted successfully.');
}


















public function Eventindex(Request $request)
    {
        // Get all categories, department types, and locations
        $categories = Category::where('status', 1)->get();
        $depttypes = Depttype::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();

        // Start with all events
        $events = Event::where('status', 1);

        // Filter events based on form inputs
        if ($request->keywords) {
            $events->where('title', 'like', '%' . $request->keywords . '%');
        }

        if ($request->location) {
            $events->where('location_id', $request->location);
        }

        if ($request->category) {
            $events->where('category_id', $request->category);
        }

        if ($request->depttype) {
            $events->where('dept_type_id', $request->depttype);
        }

        if ($request->duration) {
            $events->where('duration', $request->duration);
        }

        // Get filtered events
        $filteredEvents = $events->paginate(10);

        return view('front.layouts.Event.eventindex', [
            'categories' => $categories,
            'depttypes' => $depttypes,
            'locations' => $locations,
            'events' => $filteredEvents
        ]);
    }
















    


    public function applyJob(Request $request)
    {
        //echo "User said yes";

        // Retrieve data from the request
        $id = $request->id;
        $userId = Auth::id();
    
        // Check if the user is the organizer of the event
        $organizerId = DB::table('events')->where('id', $id)->value('user_id');
        if ($organizerId == $userId) {
            $message = 'You cannot apply to your own event.';
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }
    
        // Check if the user has already applied to this event
        $applicationCount = DB::table('eventapplications')
            ->where('admitted_user_id', $userId)
            ->where('event_id', $id)
            ->count();
    
        if ($applicationCount > 0) {
            $message = 'You have already applied to this event.';
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }
    
        // Insert the new application
        DB::table('eventapplications')->insert([
            'event_id' => $id,
            'organizer_user_id' => $organizerId,
            'admitted_user_id' => $userId,
            'applied_date' => now()
        ]);
    
        $message = 'You have successfully applied.';
        session()->flash('success', $message);
    
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }






















// //*****************************************************Admin *******************************************************************
// *************************************************************************************************************************** */
public function dashboardindex(){
    return view('front.layouts.admin.dashboard');
}






















public function showingallusers(){
    $users=User::orderBy('created_at','DESC')->paginate(10);
    return view('front.layouts.admin.showingallusers',[
        'users'=>$users
    ]);
}


public function showingallusers2(){
    $users=User::orderBy('created_at','DESC')->paginate(10);
    return view('front.layouts.admin.showingallusers2',[
        'users'=>$users
    ]);
}


public function destroy($id)
{
    // $user = User::findOrFail($id);
    // $user->delete();
    //return response()->json(['success' => 'User deleted successfully']);


    $user = User::findOrFail($id);
    $status = $user->delete();
    return redirect()->route('dashboardindex')->with('status', $status);
}





public function destroy2(Request $request){
    $id = $request->id;

    $user = User::find($id);

    if ($user == null) {
        session()->flash('error','User not found');
        return response()->json([
            'status' => false,
        ]);
    }

    $user->delete();
    session()->flash('success','User deleted successfully');
    return response()->json([
        'status' => true,
    ]);
}




















public function showingalljobs(){
    $events=Event::orderBy('created_at','DESC')->paginate(10);
    return view('front.layouts.admin.showingalljobs',[
         'events'=>$events
    ]);
}




public function destroyevent(Request $request) {
    $id = $request->id;

    $event = Event::find($id);

    if ($event == null) {
        session()->flash('error','Either job deleted or not found');
        return response()->json([
            'status' => false                
        ]);
    }

    $event->delete();
    session()->flash('success','Event deleted successfully.');
    return response()->json([
        'status' => true                
    ]);
}















public function admineditjob($id){
    $event=Event::findOrFail($id);

    $categories=Category::orderBy('name','ASC')->get();
    $depttypes=Depttype::orderBy('name','ASC')->get();
    $locations=Location::orderBy('name','ASC')->get();

    return view('front.layouts.admin.editevent',[
        'event'=>$event,
        'categories'=>$categories,
        'depttypes'=>$depttypes,
        'locations'=>$locations
    ]);
}



















public function updatejobByadmin(Request $request, $id) {

    $rules = [
        'title' => 'required|min:5|max:200',
        'category' => 'required',
        'jobType' => 'required',
        'vacancy' => 'required|integer',
        'location' => 'required|max:50',
        'description' => 'required',
        'club_name' => 'required|min:3|max:75',          

    ];

    $validator = Validator::make($request->all(),$rules);

    if ($validator->passes()) {

        $event = Event::find($id);
        $event->title = $request->title;
        $event->category_id = $request->category;
        $event->dept_type_id  = $request->jobType;
        $event->vacancy = $request->vacancy;
        $event->registrationfees = $request->registrationfees;
        $event->location_id = $request->location;
        $event->description = $request->description;
        $event->benefits = $request->benefits;
        $event->responsibility = $request->responsibility;
        $event->qualifications = $request->qualifications;
        $event->keywords = $request->keywords;
        $event->duration = $request->duration;
        $event->club_name = $request->club_name;
        $event->club_location = $request->club_location;
        $event->club_website = $request->website;

        $event->status = $request->status;
        $event->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
        $event->save();

        session()->flash('success','Event updated successfully.');

        return response()->json([
            'status' => true,
            'errors' => []
        ]);

    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}













public function commentfunc(Request $request)
{
    $eventid = $request->input('event_id');
    $sender_id = $request->input('sender_id');
    $organizer_id = $request->input('organizer_id');

    // Fetch sender's name
    $sender_name = User::find($sender_id)->name;


    echo $eventid;
    echo $sender_id;
    echo $organizer_id;
    echo $sender_name;

    $list = DB::table('chat')
        ->where('event_id', $eventid)
        ->get();

    $data = [
        'eventid' => $eventid,
        'sender_id' => $sender_id,
        'sender_name' => $sender_name,
        'organizer_id' => $organizer_id,
        'list' => $list, // Passing the $list variable to the view
    ];

    // Return the view with the data
    return view('comment', $data);
}

public function savecomment(Request $request)
{
    // $sender_id = $request->input('sender_id');
    // $sender_name = User::find($sender_id)->name;

    $query = DB::table('chat')->insert([
        'event_id' => $request->input('event_id'),
        'sender_id' =>$request->input('sender_id'),// Keep sender_id
        'sender_name' => $request->input('sender_name'), // Add sender_name
        'event_organizer_id' => $request->input('organizer_id'),
        'msg' => $request->input('message'), // Change 'message' to 'msg'
    ]);

    if ($query) {
        return response()->json(['status' => true, 'data' => [
            'user_name' =>  $request->input('sender_name'), // Ensure sender_name is passed
            'message' => $request->input('message'),
        ]]);
    } else {
        return response()->json(['status' => false]);
    }
}



}