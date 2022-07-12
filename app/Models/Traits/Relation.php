<?php

namespace App\Models\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

trait Relation
{
    private $permissions = [
        'access',
        'create',
        'edit',
        'delete',
        'show'
    ];

    public function touch_permission($table)
    {
        $role = Role::where('title', 'Admin')->first();

        if ($role) {

            foreach ($this->permissions as $permission){

                $new_permission = Permission::create([
                    'title' => $table . '_' . $permission
                ]);

                DB::table('permission_role')->insert(
                    array(
                        'role_id'         =>   $role->id,
                        'permission_id'   =>   $new_permission->id
                    )
                );
            }
        }
    }
}
