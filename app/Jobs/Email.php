<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;
use Auth;

class Email implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120;

    protected $mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MailController $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(Auth::user())->queue($this->mail);
    }
}
