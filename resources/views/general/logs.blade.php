@extends('layouts.main')
@section('title', 'Logs')
@section('content')
    <div class="float-left"><h1 class="mt-4">Logs</h1></div>
    <div class="float-right">
    </div>
    <div class="clearfix"></div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Logs</li>
    </ol>
    @include('partials.message')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            All Logs
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered list-datatables the-table" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>

        $(function() {

            $('#dataTable').DataTable({
                searching: false,
                serverSide: true,
                pagingType:"full_numbers",
                ajax: '{!! route('general.logs') !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'description',
                        name: 'description'
                    },
                ]

            });

        });

    </script>
@endsection
