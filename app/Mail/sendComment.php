<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendComment extends Mailable
{
    use Queueable, SerializesModels;
	
	public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
        return $this->from(['address' => $this->data['email'], 'name' => $this->data['name']])
				->subject('RE: ' . $this->data['listing']->name)
                ->view('emails.sendComment')
				->with(['data' => $this->data]);
			
    }
}
