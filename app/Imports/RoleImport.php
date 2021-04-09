<?php

namespace App\Imports;

use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RoleImport implements ToModel, WithChunkReading, ShouldQueue, WithStartRow
{
    public function model(array $row)
    {
        return new Role([
            'name'=> $row[0]
        ]);
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }
}
