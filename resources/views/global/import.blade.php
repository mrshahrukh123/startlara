@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Import</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{$parent_menu_link}}">{{$parent_menu_name}}</a></li>
        <li class="breadcrumb-item active">Import</li>
    </ol>
    @include('partials.message')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-import mr-1"></i>
            Import
        </div>
        <div class="card-body">
            {!! Form::open(['method'=> 'POST',
                    'files'=>true]) !!}
            <div class="mb-20">
                {!!Form::label('excel_file', 'Excel File',['class'=>'control-label pl-13']) !!}
                {!!Form::file('excel_file',null ,['class'=> 'form-control']) !!}
            </div>
            <div class="mb-20">
                {!!Form::submit('Import', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

