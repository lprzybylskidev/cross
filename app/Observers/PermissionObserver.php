<?php

namespace App\Observers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionObserver
{
    public function created(Permission $permission): void
    {
        try {
            $admin = Role::findByName('admin', $permission->guard_name);
            $admin->givePermissionTo($permission);
            app(PermissionRegistrar::class)->forgetCachedPermissions();
        } catch (\Throwable $e) {
            //
        }
    }
}
