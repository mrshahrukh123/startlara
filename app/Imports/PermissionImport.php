<?php

namespace App\Imports;

use App\SpatiePermissionModelsPermission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SpatiePermissionModelsPermission([
            //
        ]);
    }
}
