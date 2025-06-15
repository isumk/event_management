<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('event.{eventId}', function ($user, $eventId) {

    return true;
});


