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
        Permission::create(['name' => 'backend options']);
        Permission::create(['name' => 'backend permissions']);
        Permission::create(['name' => 'backend roles']);
        Permission::create(['name' => 'backend media']);
        Permission::create(['name' => 'backend users']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo([
            'backend options',
            'backend permissions',
            'backend roles',
            'backend media',
            'backend users',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            'backend roles',
            'backend users',
        ]);

        // assign roles to user
        $user = Users::where('email', 'superadmin@email.com')->first();
        $user->assignRole('superadmin');
    }
}
