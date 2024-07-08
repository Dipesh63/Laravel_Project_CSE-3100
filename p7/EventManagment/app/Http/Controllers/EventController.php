<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Depttype;
use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;

class EventController extends Controller
{
   


    // public function Eventindex(Request $request)
    // {
    //     // Get all categories, department types, and locations
    //     $categories = Category::where('status', 1)->get();
    //     $depttypes = Depttype::where('status', 1)->get();
    //     $locations = Location::where('status', 1)->get();

    //     // Start with all events
    //     $events = Event::where('status', 1);

    //     // Filter events based on form inputs
    //     if ($request->keywords) {
    //         $events->where('title', 'like', '%' . $request->keywords . '%');
    //     }

    //     if ($request->location) {
    //         $events->where('location_id', $request->location);
    //     }

    //     if ($request->category) {
    //         $events->where('category_id', $request->category);
    //     }

    //     if ($request->depttype) {
    //         $events->where('dept_type_id', $request->depttype);
    //     }

    //     if ($request->duration) {
    //         $events->where('duration', $request->duration);
    //     }

    //     // Get filtered events
    //     $filteredEvents = $events->paginate(10);

    //     return view('front.layouts.Event.eventindex', [
    //         'categories' => $categories,
    //         'depttypes' => $depttypes,
    //         'locations' => $locations,
    //         'events' => $filteredEvents
    //     ]);
    // }



    
}
