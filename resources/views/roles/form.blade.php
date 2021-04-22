@extends('layouts.main')
@section('title', 'Roles')
@section('content')
    <h1 class="mt-4">Roles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('manage.roles.index')}}">Roles</a></li>
        <li class="breadcrumb-item active">{{$newObj->id > 0 ? 'Edit' : 'Create'}} Roles</li>
    </ol>
    @include('partials.message')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">{{$newObj->id > 0 ? 'Edit' : 'Create'}} Role</h3></div>
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
                <div class="row mb-3">
                    @forelse ($permissions as $title => $permission_section)
                        @if($loop->index!=0 && $loop->index%4==0)
                </div>
                <div class="row mb-3">
                    @endif
                    <div class="col-3">
                        <h4>{{ucfirst($title)}}</h4>
                        @foreach($permission_section as $permission)
                            <div class="custom-control custom-checkbox custom-control">
                                <input name="permission[]" type="checkbox" class="custom-control-input" id="permission-{{$permission->id}}" value="{{$permission->id}}" {{ in_array($permission->id,$checked) ? "checked" : "" }}>
                                <label class="custom-control-label" for="permission-{{$permission->id}}">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>


                    @empty
                        <span>No Permission</span>
                    @endforelse
                </div>
            </div>
            <div class="mb-20">
                {!!Form::submit('Save', ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
