<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use function Laravel\Prompts\text;

class MakeFeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-feature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Migration, Controller, Model and a FormRequest';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tableName = text('Type the name of your migration table');
        $ctrlName = text('Type the name of your controller');
        $formRequestName = text('Type the name of your form request');

        Artisan::call("make:migration create_{$tableName}_table");
        Artisan::call("make:controller {$ctrlName}Controller");
        Artisan::call("make:model {$ctrlName}");
        Artisan::call("make:request {$formRequestName}");

        Artisan::call("make:test {$ctrlName}ControllerTest");
    }
}
