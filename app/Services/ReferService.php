<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Jobs\ReferFriend;

class ReferService {

    /**
     * Method to send Email request to user who was refer by user
     * 
     * @param Illuminate\Http\Request
     */
    public function sendReferRequest(Request $request) {
        return dispatch (new ReferFriend ($request->user(), $request->email));        
    }
}