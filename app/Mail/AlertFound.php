<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertFound extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 
	 protected $data;
    public function __construct($data=null)
    {
        //
		
	
		
		$this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
		
		
		return $this->from(['address' => 'alerts@condosurfing.ca', 'name' => 'CondoSurfing'])
				->subject('You have new Classified Listing Alerts!')
                ->view('emails.alertfound')
				->with(['data' => $this->data]);
			
				
  
    }
}
