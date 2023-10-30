<?php

namespace App\Console\Commands;

use App\Processors\Processor;
use Illuminate\Console\Command;

class ProcessUploads extends Command
{
    private Processor $processor;

    public function __construct(Processor $processor)
    {
        parent::__construct();
        $this->processor = $processor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-uploads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Reading CSV files....');
        $this->processor->run();
        $this->info('Report genarated successfully!....');
        $this->info('Done!');
    }
}
