<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReport extends Mailable
{
    use Queueable, SerializesModels;

    public $users;
    public $posts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users,$posts)
    {
        $this->users = $users;
        $this->posts = $posts;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.daily_report');
    }
}
