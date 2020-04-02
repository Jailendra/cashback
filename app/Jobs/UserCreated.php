<?php

namespace App\Jobs;

// use Illuminate\Bus\Queueable;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;

use App\User;

class UserCreated implements ShouldQueue
{
    // use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $reference_code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $reference_code = null)
    {
        $this->reference_code = $reference_code;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // set referedby if exists
        trim ($this->reference_code) ? $this->user->update(['refered_by' => $this->referedBy ($this->reference_code)]) : null;

        // generate refrence-code of the user
        $this->setReferenceCode();
    }

    private function referedBy (string $reference_code):int {
        return User::where('reference_code', trim ($reference_code))->first()->id;
    }

    private function generateRefrenceCode ($length = 10):string {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    private function setReferenceCode () {
        if (!User::where('reference_code', $reference_code = $this->generateRefrenceCode())->exists()) {
            $this->user->update (['reference_code' => $reference_code]);
        } else {
            $this->setReferenceCode();
        }
    }
}
