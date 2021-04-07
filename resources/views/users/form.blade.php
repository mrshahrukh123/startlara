@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('manage.users.index')}}">Users</a></li>
        <li class="breadcrumb-item active">Create User</li>
    </ol>
    @include('partials.message')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Create User</h3></div>
        <div class="card-body">
            {!! Form::model($newObj,
                    ['method'=>($newObj->id > 0) ? 'PATCH' : 'POST',
                    'route'=>($newObj->id > 0) ? ['manage.users.update',$newObj] : ['manage.users.store'],
                    'files'=>true]) !!}
            <div class="form-group">
                {!!Form::label('first_name', 'First Name') !!}
                {!!Form::text('first_name',null ,['class'=> 'form-control' . ($errors->has('first_name') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {!!Form::label('last_name', 'Last Name') !!}
                {!!Form::text('last_name',null ,['class'=> 'form-control' . ($errors->has('last_name') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {!!Form::label('email', 'Email') !!}
                {!!Form::email('email',null ,['class'=> 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {!!Form::label('phone_number', 'Phone Number') !!}
                {!!Form::text('phone_number',null ,['class'=> 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {!!Form::label('password', 'Password') !!}
                {!!Form::password('password',['class'=> 'form-control' . ($errors->has('password') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {!!Form::label('password_confirmation', 'Confirm Password') !!}
                {!!Form::password('password_confirmation',['class'=> 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-check">
                {!!Form::label('role', 'Role/s', ['class'=>'custom-input mb-10']) !!}
                @forelse ($roles as $role)
                    <div class="custom-control custom-checkbox custom-control">
                        <input name="role[]" type="checkbox" class="custom-control-input" id="permission-{{$role->id}}" value="{{$role->id}}" {{ in_array($role->id,$checked) ? "checked" : "" }}>
                        <label class="custom-control-label" for="permission-{{$role->id}}">{{$role->name}}</label>
                    </div>
                @empty
                    <span>No Role</span>
                @endforelse
            </div>
            <div class="form-group">
                {!!Form::label('dob', 'Date of Birth') !!}
                {!!Form::text('dob',null,['class'=> 'form-control' . ($errors->has('dob') ? ' is-invalid' : '')]) !!}
                @if ($errors->has('dob'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span>
                @endif
            </div>
            <div class="mb-20">
                {!!Form::submit('Save', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            $('#dob').datepicker({
                format: 'yyyy-mm-dd'
            })
        });
    </script>
@endsection
