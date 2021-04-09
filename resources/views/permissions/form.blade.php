@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Permissions</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('manage.permissions.index')}}">Permissions</a></li>
        <li class="breadcrumb-item active">Create Permissions</li>
    </ol>
    @include('partials.message')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Permission</h3></div>
        <div class="card-body">
            {!! Form::model($newObj,
                    ['method'=>($newObj->id > 0) ? 'PATCH' : 'POST',
                    'route'=>($newObj->id > 0) ? ['manage.permissions.update',$newObj] : ['manage.permissions.store'],
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
                {!!Form::submit('Save', ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
