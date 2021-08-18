<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateBadgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:badge {name} {points}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Badge';

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
    {
        $stub = file_get_contents(__DIR__ .'/badge.stub');
        $stub = str_replace('{{CLASS}}',$this->argument('name'),$stub);
        $stub = str_replace('{{POINTS}}',$this->argument('points'),$stub);
        file_put_contents(app_path('Badge/' .$this->argument('name') .'.php'),$stub);
        $this->info('app/Badge/' .$this->argument('name'));
    }
}
