<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChannelEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $channel = '';

    private $userName = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($channel, $userName)
    {
        $this->channel = $channel;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('prackainz@gmail.com', 'Channel Message')->view('mail',[
            'name' => $this->channel,
            'user' => $this->userName
        ]);
    }
}
