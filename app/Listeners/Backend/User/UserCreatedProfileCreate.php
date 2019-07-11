<?php

namespace App\Listeners\Backend\User;

use App\Events\Backend\User\UserCreated;
use App\Models\Userprofile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class UserCreatedProfileCreate implements ShouldQueue
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
     * @param UserCreated $event
     *
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        $userprofile = new Userprofile();
        $userprofile->user_id = $user->id;
        $userprofile->name = $user->name;
        $userprofile->first_name = $user->first_name;
        $userprofile->last_name = $user->last_name;
        $userprofile->email = $user->email;
        $userprofile->mobile = $user->mobile;
        $userprofile->gender = $user->gender;
        $userprofile->date_of_birth = $user->date_of_birth;
        $userprofile->avatar = $user->avatar;
        $userprofile->status = ($user->status > 0) ? $user->status : 0;
        $userprofile->save();

        Log::info('UserCreatedProfileCreate: '.$userprofile->name.'(Id:'.$userprofile->user_id.')');
    }
}
