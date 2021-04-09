<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    public function getPermissionIdsAttribute()
    {
        return $this->permissions()->pluck('permission_id')->toArray();
    }
}
