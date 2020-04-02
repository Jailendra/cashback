<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Mail\ReferFriend as ReferFriendEmail;
use Illuminate\Contracts\Mail\Mailer;

class ReferFriend implements ShouldQueue
{
    private $user;
    private $refer_email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $refer_email)
    {
        $this->user = $user;
        $this->refer_email = $refer_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {
        $mailer->to($this->refer_email)->send (new ReferFriendEmail ($this->user->email, [
            'reference_code' => $this->user->reference_code,
            'name' => $this->user->name,
        ]));
    }
}
