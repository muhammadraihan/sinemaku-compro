<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // 1. Create permissions
        $permissions = [
            'view articles', 'create articles', 'edit articles', 'delete articles',
            'view events', 'create events', 'edit events', 'delete events',
            'view films', 'create films', 'edit films', 'delete films',
            'view behind the scenes', 'create behind the scenes', 'edit behind the scenes', 'delete behind the scenes',
            'view shops', 'create shops', 'edit shops', 'delete shops',
            'view jobs', 'create jobs', 'edit jobs', 'delete jobs',
            'view castings', 'create castings', 'edit castings', 'delete castings',
            'view memberships', 'create memberships', 'edit memberships', 'delete memberships',
            'view users', 'create users', 'edit users', 'delete users',
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view permissions', 'create permissions', 'edit permissions', 'delete permissions',
            'view menus', 'create menus', 'edit menus', 'delete menus',
            'view logs',
            'view settings', 'edit settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Create Role
        $role = Role::firstOrCreate(['name' => 'superadmin']);
        $role->syncPermissions(Permission::all());

        // 3. Create User
        $user = User::create([
            'name' => 'Admin Sinemaku',
            'email' => 'admin@sinemaku.com',
            'password' => Hash::make('password'),
            'uuid' => (string) Str::uuid(),
        ]);
        $user->assignRole($role->name);

        // 4. Create Menus
        $menus = [
            ['menu_title' => 'Dashboard', 'route_name' => 'backoffice.dashboard', 'icon_class' => 'fal fa-desktop', 'order' => 0, 'created_by' => $user->uuid],
            ['menu_title' => 'Master', 'icon_class' => 'fal fa-box', 'order' => 1, 'created_by' => $user->uuid],
            ['menu_title' => 'Kategori', 'route_name' => 'kategori.index', 'parent_id' => 2, 'order' => 1, 'created_by' => $user->uuid],
            ['menu_title' => 'Kategori Shop', 'route_name' => 'kategorishop.index', 'parent_id' => 2, 'order' => 2, 'created_by' => $user->uuid],
            ['menu_title' => 'Kategori Artikel', 'route_name' => 'artikel-kategori.index', 'parent_id' => 2, 'order' => 3, 'created_by' => $user->uuid],
            ['menu_title' => 'Kategori Event', 'route_name' => 'event-kategori.index', 'parent_id' => 2, 'order' => 4, 'created_by' => $user->uuid],
            ['menu_title' => 'Film / Series', 'route_name' => 'film.index', 'icon_class' => 'fal fa-film', 'order' => 3, 'created_by' => $user->uuid],
            ['menu_title' => 'Episodes', 'route_name' => 'episode.index', 'icon_class' => 'fal fa-video', 'order' => 4, 'created_by' => $user->uuid],
            ['menu_title' => 'Behind The Scene', 'route_name' => 'bts.index', 'icon_class' => 'fal fa-film', 'order' => 5, 'created_by' => $user->uuid],
            ['menu_title' => 'Shop', 'route_name' => 'shop.index', 'icon_class' => 'fal fa-shopping-cart', 'order' => 6, 'created_by' => $user->uuid],
            ['menu_title' => 'Article', 'route_name' => 'article.index', 'icon_class' => 'fal fa-newspaper', 'order' => 7, 'created_by' => $user->uuid],
            ['menu_title' => 'Career', 'route_name' => 'job.index', 'icon_class' => 'fal fa-chart-line', 'order' => 8, 'created_by' => $user->uuid],
            ['menu_title' => 'Casting', 'route_name' => 'casting.index', 'icon_class' => 'fal fa-camera-alt', 'order' => 9, 'created_by' => $user->uuid],
            ['menu_title' => 'Event', 'route_name' => 'event.index', 'icon_class' => 'fal fa-tablet-rugged', 'order' => 10, 'created_by' => $user->uuid],
            ['menu_title' => 'Membership', 'route_name' => 'membership.index', 'icon_class' => 'fal fa-address-card', 'order' => 11, 'created_by' => $user->uuid],
            ['menu_title' => 'Data User PHYK', 'route_name' => 'phyk.index', 'icon_class' => 'fal fa-users', 'order' => 12, 'created_by' => $user->uuid],
            ['menu_title' => 'About Page', 'route_name' => 'settings.about', 'icon_class' => 'fal fa-info-circle', 'order' => 13, 'created_by' => $user->uuid],
            ['menu_title' => 'Access Control', 'icon_class' => 'fal fa-cog', 'order' => 14, 'created_by' => $user->uuid],
            ['menu_title' => 'Permission Management', 'route_name' => 'permissions.index', 'parent_id' => 18, 'order' => 1, 'created_by' => $user->uuid],
            ['menu_title' => 'Menu Management', 'route_name' => 'menus.index', 'parent_id' => 18, 'order' => 2, 'created_by' => $user->uuid],
            ['menu_title' => 'Role Management', 'route_name' => 'roles.index', 'parent_id' => 18, 'order' => 3, 'created_by' => $user->uuid],
            ['menu_title' => 'User Management', 'route_name' => 'users.index', 'parent_id' => 18, 'order' => 4, 'created_by' => $user->uuid],
            ['menu_title' => 'System Logs', 'route_name' => 'logs', 'icon_class' => 'fal fa-shield-check', 'order' => 15, 'created_by' => $user->uuid],
        ];

        foreach ($menus as $menuData) {
            Menu::create($menuData);
        }

        // Attach menus to role
        $role->menus()->attach(Menu::all());
    }
}
