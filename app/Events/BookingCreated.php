<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Booking $booking
    ) {}

    public function broadcastOn(): Channel
    {
        return new Channel('bookings');
    }

    public function broadcastWith(): array
    {
        return [
            'event_title' => $this->booking->event->title,
            'user_name' => $this->booking->user->name,
            'message' => "Booking confirmed for {$this->booking->event->title}",
        ];
    }
}