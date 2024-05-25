<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\loginmailtest;
use App\Mail\Ticketmail;
use Illuminate\Support\Facades\Mail;

class ticketjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;  
   
    public function __construct($user)
    {        
        $this->user = $user;
    }

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new Ticketmail($this->user));
    }
}
