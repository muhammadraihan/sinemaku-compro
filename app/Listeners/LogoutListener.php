<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Carbon\Carbon;
use Auth;

class LogoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Get the user from the event or fallback
        $user = $event->user ?? Auth::user();

        if (!$user) {
            return;
        }

        // Determine the user's name
        $name = $user->name ?? ($user->first_name . ' ' . $user->last_name ?? 'Unknown');

        // Logging logout event
        $updated_at = Carbon::now()->toDateTimeString();
        $properties = [
            'attributes' =>
            [
            'name' => $name,
            'description' => 'Logout from system at '.$updated_at
            ]
        ];
        $desc = 'User '.$name.' logged out from the system';
        activity('auth')
        ->performedOn($user)
        ->causedBy($user)
        ->withProperties($properties)
        ->log($desc);
    }
}
