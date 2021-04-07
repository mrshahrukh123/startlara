@extends('layouts.email')
@section('content')
    <p>Your Password reset token is: {{$token}}</p>
@endsection
