<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailListingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends email for thoses who have alerts setup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        print "output";
		$message="test message";
		Mail::raw("This is a test", function($message) use ($a)
		{
			$message->from('test@test.com');
			$message->to('clf55@rogers.com');
			
		});
		$this->info('mail has been sent');
    }
}
