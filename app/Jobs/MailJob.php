<?php

namespace App\Jobs;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // return view('welcome');
    $recipient = 'amrfathymohamed7056@gmail.com'; // Replace with the receiver's email

    Mail::to($recipient)->send(new TestEmail());

    }
}
