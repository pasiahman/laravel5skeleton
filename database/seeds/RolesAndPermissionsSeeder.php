<?php

use Illuminate\Database\Seeder;
use Modules\Users\Models\Users;
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
        // create roles and assign existing permissions
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo([
            'backend categories',
            'backend custom links',
            'backend custom links delete',
            'backend custom links trash',
            'backend dashboard',
            'backend geocodes',
            'backend main',
            'backend masters',
            'backend media',
            'backend media all',
            'backend media delete',
            'backend media role',
            'backend media trash',
            'backend medium categories',
            'backend menus',
            'backend options',
            'backend permissions',
            'backend pages',
            'backend pages delete',
            'backend pages trash',
            'backend posts',
            'backend posts delete',
            'backend posts trash',
            'backend roles',
            'backend tags',
            'backend user addresses',
            'backend users',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'backend categories',
            'backend custom links',
            'backend dashboard',
            'backend main',
            'backend masters',
            'backend media',
            'backend media role',
            'backend medium categories',
            'backend pages',
            'backend posts',
            'backend roles',
            'backend tags',
            'backend user addresses',
            'backend users',
        ]);

        // assign roles to user
        $user = Users::where('email', 'superadmin@email.com')->first();
        $user->assignRole('superadmin');

        $user = Users::where('email', 'admin@email.com')->first();
        $user->assignRole('admin');
    }
}
