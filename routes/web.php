<?php

use App\Jobs\MailJob;
use App\Jobs\TestingJob;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\URL;

if(app()->environment('production')){
    URL::forceScheme('https');
}

Route::get('/posts', function () {

     $recipient = 'amr.1223022@stemalex.moe.edu.eg'; // Replace with the receiver's email

    Mail::to($recipient)->send(new TestEmail());
});
