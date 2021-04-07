@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Roles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('manage.roles.index')}}">Roles</a></li>
        <li class="breadcrumb-item active">Create Roles</li>
    </ol>
    @include('partials.message')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Role</h3></div>
        <div class="card-body">
            {!! Form::model($newObj,
                    ['method'=>($newObj->id > 0) ? 'PATCH' : 'POST',
                    'route'=>($newObj->id > 0) ? ['manage.roles.update',$newObj] : ['manage.roles.store'],
                    'files'=>true]) !!}

            <div class="mb-20">
                {!!Form::label('name', 'Name',['class'=>'control-label pl-13']) !!}
                {!!Form::text('name',null ,['class'=> 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <div class="mb-20">
                {!!Form::label('permission', 'Permissions', ['class'=>'custom-input mb-10']) !!}
                @forelse ($permissions as $permission)
                    <div class="custom-control custom-checkbox custom-control">
                        <input name="permission[]" type="checkbox" class="custom-control-input" id="permission-{{$permission->id}}" value="{{$permission->id}}" {{ in_array($permission->id,$checked) ? "checked" : "" }}>
                        <label class="custom-control-label" for="permission-{{$permission->id}}">{{$permission->page_key}}</label>
                    </div>
                @empty
                    <span>No Permission</span>
                @endforelse
            </div>
            <div class="mb-20">
                {!!Form::submit('Save', ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
