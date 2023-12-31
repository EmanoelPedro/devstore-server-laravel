<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateDefaultMasterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-master-admin';

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
        
        if(!Schema::hasTable('users')) {
            print("The users table does not exist in the database. Check if the migrations were run. \n");
            die();
        } else if(!Schema::hasTable('roles')) {
            print("The roles table does not exist in the database. Check if the migrations were run. \n");
            die();
        } else if(!Schema::hasTable('permissions')) {
            print("The roles table does not exist in the database. Check if the migrations were run. \n");
            die();
        } 


        $first_name = "Master";
        $last_name = "Admin";
        $email = "gerent@admin.com";
        $password = Hash::make("admin");

        if(User::where("email", $email)->first()) {
            print(PHP_EOL ."The default administrator user has already been created in the database, ". PHP_EOL . PHP_EOL . 
            "Email ==> {$email}" . PHP_EOL.
            "Password ==> admin" . PHP_EOL . PHP_EOL .
            " remember to change your email and password to avoid hackers when in production! \n" . PHP_EOL);
            die();
        }
        // Insert User in DB
        $user = User::create([
            'first_name'=> $first_name,
            'last_name'=> $last_name,
            'gender' => 'unconfirmed',
            'email'=> $email,
            'password'=> $password,
            'email_verified_at' => now(),
            "created_at" => now()
        ]);

        $role = Role::create(['name' => 'root']);
        $permissions[0] = Permission::create(['name' => 'create users']);
        $permissions[1] = Permission::create(['name' => 'edit users']);
        $permissions[2] = Permission::create(['name' => 'delete users']);

        $permissions[3] = Permission::create(['name' => 'create role']);
        $permissions[4] = Permission::create(['name' => 'edit role']);
        $permissions[5] = Permission::create(['name' => 'delete role']);

        $role->syncPermissions($permissions);

        $user->assignRole('root');

        print(PHP_EOL ."The default administrator user has been created successfully. ". PHP_EOL . PHP_EOL . 
        "Email ==> {$email}" . PHP_EOL.
        "Password ==> admin" . PHP_EOL . PHP_EOL . 
        " remember to change email and password to avoid hackers when in production! \n" . PHP_EOL);


    }
}
