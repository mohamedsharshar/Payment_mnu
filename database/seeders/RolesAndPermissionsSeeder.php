<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::create(['name' => 'admin']);
        $studentRole = Role::create(['name' => 'student']);

        $permissions = [
            'view-dashboard',
            'manage-customers',
            'manage-bills',
            'manage-services',
            'manage-payments',
            'view-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->givePermissionTo(Permission::all());

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@student.com',
            'password' => Hash::make('password'),
        ]);

        $student->assignRole('student');
    }
}
