@extends('layouts.main')
@section('title', 'Settings')
@section('content')
    <h1 class="mt-4">Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Settings</li>
    </ol>
    @include('partials.message')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Settings</h3></div>
        <div class="card-body">
            <p>Design a form to handle any global settings</p>
        </div>
    </div>

@endsection

@section('javascript')
@endsection
