<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Add roles
        $roles = [
            [
                'name'        => 'System Administrator',
                'slug'        => 'admin',
                'description' => 'System administrator with all permissions',
                'is_active'   => true,
                'order'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Super Administrator',
                'slug'        => 'super_admin',
                'description' => 'Super administrator with full system access',
                'is_active'   => true,
                'order'       => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Employee',
                'slug'        => 'employee',
                'description' => 'Employee with limited permissions',
                'is_active'   => true,
                'order'       => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Designer',
                'slug'        => 'designer',
                'description' => 'Designer with design and project permissions',
                'is_active'   => true,
                'order'       => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Regular User',
                'slug'        => 'user',
                'description' => 'Regular user with basic permissions',
                'is_active'   => true,
                'order'       => 5,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('roles')->insert($roles);

        // Add permissions
        $permissions = [
            // User permissions
            ['name' => 'View Users', 'slug' => 'view_users', 'group' => 'users', 'order' => 1],
            ['name' => 'Create Users', 'slug' => 'create_users', 'group' => 'users', 'order' => 2],
            ['name' => 'Edit Users', 'slug' => 'edit_users', 'group' => 'users', 'order' => 3],
            ['name' => 'Delete Users', 'slug' => 'delete_users', 'group' => 'users', 'order' => 4],

            // Role permissions
            ['name' => 'View Roles', 'slug' => 'view_roles', 'group' => 'roles', 'order' => 5],
            ['name' => 'Create Roles', 'slug' => 'create_roles', 'group' => 'roles', 'order' => 6],
            ['name' => 'Edit Roles', 'slug' => 'edit_roles', 'group' => 'roles', 'order' => 7],
            ['name' => 'Delete Roles', 'slug' => 'delete_roles', 'group' => 'roles', 'order' => 8],

            // Service permissions
            ['name' => 'View Services', 'slug' => 'view_services', 'group' => 'services', 'order' => 9],
            ['name' => 'Create Services', 'slug' => 'create_services', 'group' => 'services', 'order' => 10],
            ['name' => 'Edit Services', 'slug' => 'edit_services', 'group' => 'services', 'order' => 11],
            ['name' => 'Delete Services', 'slug' => 'delete_services', 'group' => 'services', 'order' => 12],

            // Project permissions
            ['name' => 'View Projects', 'slug' => 'view_projects', 'group' => 'projects', 'order' => 13],
            ['name' => 'Create Projects', 'slug' => 'create_projects', 'group' => 'projects', 'order' => 14],
            ['name' => 'Edit Projects', 'slug' => 'edit_projects', 'group' => 'projects', 'order' => 15],
            ['name' => 'Delete Projects', 'slug' => 'delete_projects', 'group' => 'projects', 'order' => 16],

            // Settings permissions
            ['name' => 'View Settings', 'slug' => 'view_settings', 'group' => 'settings', 'order' => 17],
            ['name' => 'Edit Settings', 'slug' => 'edit_settings', 'group' => 'settings', 'order' => 18],

            // Translation permissions
            ['name' => 'View Translations', 'slug' => 'view_translations', 'group' => 'translations', 'order' => 19],
            ['name' => 'Edit Translations', 'slug' => 'edit_translations', 'group' => 'translations', 'order' => 20],

            // Profile permissions (للمستخدمين العاديين)
            ['name' => 'View Profile', 'slug' => 'view_profile', 'group' => 'profile', 'order' => 21],
            ['name' => 'Edit Profile', 'slug' => 'edit_profile', 'group' => 'profile', 'order' => 22],
            ['name' => 'Change Password', 'slug' => 'change_password', 'group' => 'profile', 'order' => 23],

            // Dashboard permissions
            ['name' => 'View Dashboard', 'slug' => 'view_dashboard', 'group' => 'dashboard', 'order' => 24],
        ];

        foreach ($permissions as &$permission) {
            $permission['is_active']  = true;
            $permission['created_at'] = now();
            $permission['updated_at'] = now();
        }

        DB::table('permissions')->insert($permissions);

        // Add permissions for Admin (all permissions)
        $adminRole      = DB::table('roles')->where('slug', 'admin')->first();
        $allPermissions = DB::table('permissions')->pluck('id');

        $rolePermissions = [];
        foreach ($allPermissions as $permissionId) {
            $rolePermissions[] = [
                'role_id'       => $adminRole->id,
                'permission_id' => $permissionId,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('role_permission')->insert($rolePermissions);

        // Add permissions for Super Admin (all permissions)
        $superAdminRole = DB::table('roles')->where('slug', 'super_admin')->first();

        $superAdminRolePermissions = [];
        foreach ($allPermissions as $permissionId) {
            $superAdminRolePermissions[] = [
                'role_id'       => $superAdminRole->id,
                'permission_id' => $permissionId,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('role_permission')->insert($superAdminRolePermissions);

        // Add permissions for Employee
        $employeeRole        = DB::table('roles')->where('slug', 'employee')->first();
        $employeePermissions = DB::table('permissions')
            ->whereIn('slug', [
                'view_services',
                'view_projects',
                'view_profile',
                'edit_profile',
                'change_password',
                'view_dashboard'
            ])
            ->pluck('id');

        $employeeRolePermissions = [];
        foreach ($employeePermissions as $permissionId) {
            $employeeRolePermissions[] = [
                'role_id'       => $employeeRole->id,
                'permission_id' => $permissionId,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('role_permission')->insert($employeeRolePermissions);

        // Add permissions for Designer
        $designerRole        = DB::table('roles')->where('slug', 'designer')->first();
        $designerPermissions = DB::table('permissions')
            ->whereIn('slug', [
                'view_services',
                'view_projects',
                'create_projects',
                'edit_projects',
                'view_profile',
                'edit_profile',
                'change_password',
                'view_dashboard'
            ])
            ->pluck('id');

        $designerRolePermissions = [];
        foreach ($designerPermissions as $permissionId) {
            $designerRolePermissions[] = [
                'role_id'       => $designerRole->id,
                'permission_id' => $permissionId,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('role_permission')->insert($designerRolePermissions);

        // Add permissions for Regular User
        $userRole        = DB::table('roles')->where('slug', 'user')->first();
        $userPermissions = DB::table('permissions')
            ->whereIn('slug', [
                'view_profile',
                'edit_profile',
                'change_password',
                'view_dashboard'
            ])
            ->pluck('id');

        $userRolePermissions = [];
        foreach ($userPermissions as $permissionId) {
            $userRolePermissions[] = [
                'role_id'       => $userRole->id,
                'permission_id' => $permissionId,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('role_permission')->insert($userRolePermissions);

        // Add admin user
        DB::table('users')->insert([
            'name'              => 'System Administrator',
            'email'             => 'admin@thunder-iq.com',
            'password'          => Hash::make('password'),
            'role_id'           => $adminRole->id,
            'phone'             => '+9647722234030',
            'is_active'         => true,
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Add super admin user
        DB::table('users')->insert([
            'name'              => 'Fadi Debs',
            'email'             => 'fadi@thunder-iq.com',
            'password'          => Hash::make('12345678'), // كلمة السر من 1 إلى 8
            'role_id'           => $superAdminRole->id,
            'phone'             => '+9647722234031',
            'is_active'         => true,
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Add sample regular user
        DB::table('users')->insert([
            'name'              => 'Regular User',
            'email'             => 'user@example.com',
            'password'          => Hash::make('12345678'),
            'role_id'           => $userRole->id,
            'phone'             => '+9647722234032',
            'is_active'         => true,
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
