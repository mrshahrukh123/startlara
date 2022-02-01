<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'entity_type',
        'entity_id',
        'entity_description',
        'performed_by',
        'performed_by_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'performed_by_id','id');
    }
}
