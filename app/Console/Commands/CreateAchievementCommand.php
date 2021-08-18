<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAchievementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:achievement {name} {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a mew achievement';

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
     * Get contents of file stub and create an achievement class
     * if the folder doesnt exist create it
     */
    public function handle()
    {
        $stub = file_get_contents(__DIR__ .'/achievement.stub');
        $stub = str_replace('{{CLASS}}',$this->argument('name'),$stub);
        $stub = str_replace('{{FOLDER}}',$this->argument('folder'),$stub);
        if(!is_dir(app_path('Achievements/'.$this->argument('folder')))){
            mkdir(app_path('Achievements/'.$this->argument('folder')));
        }
        file_put_contents(app_path('Achievements/' .$this->argument('folder') . '/' .$this->argument('name') .'.php'),$stub);
        $this->info('app/Achievements/'.$this->argument('folder') . "/" .$this->argument('name'));
    }
}
