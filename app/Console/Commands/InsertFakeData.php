<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\ContactNumber;
use App\Models\Department;
use App\Models\Employee;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InsertFakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:fake-data {table} {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to insert fake data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->arguments()['table'];
        $count = $this->arguments()['count'];

        if ($table == 'ContactNumbers')
            $obj = ContactNumber::class;
        elseif ($table == 'Addresses')
            $obj = Address::class;
        elseif ($table == 'Employees')
            $obj = Employee::class;
        elseif ($table == 'Departments') {
            Artisan::call("db:seed --class=DepartmentSeeder");
            exit(0);
        }

        try {
            $obj::factory()->count($count)->create();
            exit(0);
        }
        catch (\Exception $exception) {
            throw new \Exception($exception);
        }
    }
}
