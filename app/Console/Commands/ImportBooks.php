<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\BookController;

class ImportBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importbooks:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Books by current day';

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
     * @return int
     */
    public function handle()
    {   //Log::info('run importbooks');
        // Instantiate other BookController class in this ImportBooks's method
        $book_controller = new BookController;
        // Use other BookController's method in this ImportBooks's method
        $book_controller->xml_books_store();
        //Log::info('error importbooks');
    }
}
