@extends('layouts.email')
@section('content')
    <p>You can verify using the otp: {{$user->otp}}</p>
@endsection
