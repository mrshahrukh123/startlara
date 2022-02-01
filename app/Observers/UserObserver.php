<?php

namespace App\Observers;

use App\Models\AppLog;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $performed_by = !is_null(auth()->user()) ? auth()->user()->name : 'System';
        AppLog::create([
            'name'=>'User',
            'description' =>'User created',
            'entity_type' => 'App\\Model\\User',
            'entity_description' => 'User created by '.$performed_by,
            'entity_id' => $user->id,
            'performed_by' => $performed_by,
            'performed_by_id' => auth()->id(),
        ]);
    }

    public function updated(User $user)
    {

        $performed_by = !is_null(auth()->user()) ? auth()->user()->name : 'System';
        AppLog::create([
            'name'=>'User',
            'description' =>'User updated',
            'entity_type' => 'App\\Model\\User',
            'entity_description' => 'User updated by '.$performed_by,
            'entity_id' => $user->id,
            'performed_by' => $performed_by,
            'performed_by_id' => auth()->id(),
        ]);
    }

    public function deleted(User $user)
    {
        $performed_by = !is_null(auth()->user()) ? auth()->user()->name : 'System';
        AppLog::create([
            'name'=>'User',
            'description' =>'User deleted',
            'entity_type' => 'App\\Model\\User',
            'entity_description' => 'User deleted by '.$performed_by,
            'entity_id' => $user->id,
            'performed_by' => $performed_by,
            'performed_by_id' => auth()->id(),
        ]);
    }

    public function restored(User $user)
    {
        $performed_by = !is_null(auth()->user()) ? auth()->user()->name : 'System';
        AppLog::create([
            'name'=>'User',
            'description' =>'User restored',
            'entity_type' => 'App\\Model\\User',
            'entity_description' => 'User restored by '.$performed_by,
            'entity_id' => $user->id,
            'performed_by' => $performed_by,
            'performed_by_id' => auth()->id(),
        ]);
    }

    public function forceDeleted(User $user)
    {
        $performed_by = !is_null(auth()->user()) ? auth()->user()->name : 'System';
        AppLog::create([
            'name'=>'User',
            'description' =>'User permanently delete',
            'entity_type' => 'App\\Model\\User',
            'entity_description' => 'User permanently deleted by '.$performed_by,
            'entity_id' => $user->id,
            'performed_by' => $performed_by,
            'performed_by_id' => auth()->id(),
        ]);
    }
}
