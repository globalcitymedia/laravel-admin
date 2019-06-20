<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EmptyOutBox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'outbox:empty-sent-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'outbox:emptySentMails';

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
        $query = DB::select('DELETE FROM outbox WHERE deleted_at IS NOT NULL LIMIT 10000');
    }
}
