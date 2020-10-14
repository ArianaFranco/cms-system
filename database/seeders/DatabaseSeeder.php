<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //DB::table('users')->truncate();
        //DB::table('posts')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('permission_role')->truncate();
        
        
        //User::factory(10)->create();
    

        /*
        
        User::factory()
            ->has(Post::factory()->count(2))
            ->count(10)
            ->create();
         */
    
        $role = Role::create(array('name' => 'Admin',
                           'slug' => 'Admin'));
    
        $permission = Permission::create(array('name' => 'View Dashboard',
                                 'slug' => 'view_dashboard'));
        
    
        $user = User::find(1);
        
        $user->roles()->attach($role->id);
        $user->permissions()->attach($permission->id);
        
        
        
        /*
        $user = User::find(1);
        
        Permission::factory(3)->create();
        
        Role::factory(3)->create();
        
        
        */
        
    }
}
