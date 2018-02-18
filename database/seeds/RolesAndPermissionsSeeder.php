<?php

use App\Http\Models\Users;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'backend categories']);
        Permission::create(['name' => 'backend media']);
        Permission::create(['name' => 'backend media all']);
        Permission::create(['name' => 'backend media delete']);
        Permission::create(['name' => 'backend media trash']);
        Permission::create(['name' => 'backend media role']);
        Permission::create(['name' => 'backend medium categories']);
        Permission::create(['name' => 'backend menus']);
        Permission::create(['name' => 'backend options']);
        Permission::create(['name' => 'backend permissions']);
        Permission::create(['name' => 'backend posts']);
        Permission::create(['name' => 'backend posts delete']);
        Permission::create(['name' => 'backend posts trash']);
        Permission::create(['name' => 'backend roles']);
        Permission::create(['name' => 'backend tags']);
        Permission::create(['name' => 'backend users']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo([
            'backend categories',
            'backend media',
            'backend media all',
            'backend media delete',
            'backend media role',
            'backend media trash',
            'backend medium categories',
            'backend menus',
            'backend options',
            'backend permissions',
            'backend posts',
            'backend posts delete',
            'backend posts trash',
            'backend roles',
            'backend tags',
            'backend users',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'backend categories',
            'backend media',
            'backend media role',
            'backend medium categories',
            'backend posts',
            'backend roles',
            'backend tags',
            'backend users',
        ]);

        // assign roles to user
        $user = Users::where('email', 'superadmin@email.com')->first();
        $user->assignRole('superadmin');

        $user = Users::where('email', 'admin@email.com')->first();
        $user->assignRole('admin');
    }
}
