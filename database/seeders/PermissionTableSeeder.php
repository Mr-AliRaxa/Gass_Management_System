<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permissions = [
            // 'role-list', 'role-create', 'role-edit', 'role-delete' removed
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'team-member-list',
            'team-member-create',
            'team-member-edit',
            'team-member-delete',
            'attendance-list',
            'attendance-create',
            'attendance-edit',
            'attendance-delete',
            'expense-list',
            'expense-create',
            'expense-edit',
            'expense-delete',
            'salary-list',
            'salary-create',
            'salary-edit',
            'salary-delete',
            'inventory-list',
            'inventory-create',
            'inventory-edit',
            'inventory-delete',
            'sale-list',
            'sale-create',
            'sale-edit',
            'sale-delete',
            'gas-reading-list',
            'gas-reading-create',
            'gas-reading-edit',
            'gas-reading-delete',
            'visa-detail-list',
            'visa-detail-create',
            'visa-detail-edit',
            'visa-detail-delete',
            // 'agency-list', 'agency-create', 'agency-edit', 'agency-delete' removed
            'expense-type-list',
            'expense-type-create',
            'expense-type-edit',
            'expense-type-delete',
            'customer-report-list',
            'agency-setting-list',
            'agency-setting-edit',
        ];

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
       
        foreach ($permissions as $permission) {
             Permission::firstOrCreate(['name' => $permission]);
        }
        
        // Create Admin Role
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $role->syncPermissions($permissions); // Admin gets all
        
        // Create Staff Role (Starts empty to allow full control per-user)
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $staffRole->syncPermissions([]);
        
        // Final Sync for Super Admin (Gets everything including roles)
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $allPermissionsForSuper = [
            'role-list', 'role-create', 'role-edit', 'role-delete',
            'user-list', 'user-create', 'user-edit', 'user-delete',
            'customer-list', 'customer-create', 'customer-edit', 'customer-delete',
            'team-member-list', 'team-member-create', 'team-member-edit', 'team-member-delete',
            'attendance-list', 'attendance-create', 'attendance-edit', 'attendance-delete',
            'expense-list', 'expense-create', 'expense-edit', 'expense-delete',
            'salary-list', 'salary-create', 'salary-edit', 'salary-delete',
            'inventory-list', 'inventory-create', 'inventory-edit', 'inventory-delete',
            'sale-list', 'sale-create', 'sale-edit', 'sale-delete',
            'gas-reading-list', 'gas-reading-create', 'gas-reading-edit', 'gas-reading-delete',
            'visa-detail-list', 'visa-detail-create', 'visa-detail-edit', 'visa-detail-delete',
            'agency-list', 'agency-create', 'agency-edit', 'agency-delete',
            'expense-type-list', 'expense-type-create', 'expense-type-edit', 'expense-type-delete',
        ];

        foreach ($allPermissionsForSuper as $permName) {
            Permission::firstOrCreate(['name' => $permName]);
        }
        $superAdminRole->syncPermissions(Permission::all());

        // Ensure Super Admin Role has all permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // Create Super Admin User
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();
        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'Super Admin', 
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('12345678')
            ]);
        }
        $superAdmin->assignRole($superAdminRole);

        // Create Admin User if not exists
        $user = User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User', 
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678')
            ]);
            $user->assignRole([$role->id]);
        }
    }
}
