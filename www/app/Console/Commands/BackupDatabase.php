<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\DbDumper;
use SQLite3;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This backups the database';

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
        File::put('dump.sqlite','');
        Spatie\DbDumper\Databases\Sqlite::create()
        ->setDbName(env('DB_DATABASE', database_path('database.sqlite')))
        ->dumpToFile(base_path('dump.sqlite'));
    }
}
