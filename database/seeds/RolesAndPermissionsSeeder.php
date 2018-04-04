<?php

use Illuminate\Database\Seeder;
use Modules\Users\Models\Users;
use Spatie\Permission\Models\Role;

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
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'api rajaongkir',
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
