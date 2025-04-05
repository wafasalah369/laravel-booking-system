<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessBooking;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('bookings')
                ->orderBy('start_time')
                ->paginate(10); 
        
        return view('events.index', compact('events'));
    }

    public function book(Event $event): RedirectResponse
    {
        abort_if($event->availableSeats() <= 0, 403, 'No available seats for this event.');
        
        // Dispatch the job to queue
        ProcessBooking::dispatch($event, Auth::user());

        return back()->with('success', 'Your booking is being processed!');
    }
}