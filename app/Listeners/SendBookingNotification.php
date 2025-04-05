<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingNotification
{
    public function __construct()
    {
        //
    }

    public function handle(BookingCreated $event)
    {
        // We're handling this via broadcasting instead
    }
}
