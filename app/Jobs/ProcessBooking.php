<?php

namespace App\Jobs;

use App\Events\BookingCreated;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Event $event,
        public User $user
    ) {}

    public function handle()
    {
        // Create the booking record
        $booking = Booking::create([
            'event_id' => $this->event->id,
            'user_id' => $this->user->id,
            'booked_at' => now(),
            'status' => 'confirmed'
        ]);
        // Simulate email sending (logging instead of real email)
        Log::info("Booking confirmation simulated for booking ID: {$booking->id}");
        // Trigger real-time notification
        event(new BookingCreated($booking));
    }
}