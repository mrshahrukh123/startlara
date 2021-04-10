@extends('layouts.main')
@section('title', 'Permissions')
@section('content')
    <div class="float-left"><h1 class="mt-4">Permissions</h1></div>
    <div class="float-right">
        @can('create-role')
            <a class="mt-4 btn btn-primary" href="{{route('manage.permissions.create')}}">Add New</a>
        @endcan
    </div>
    <div class="clearfix"></div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Permissions</li>
    </ol>
    @include('partials.message')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            All Permissions
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered list-datatables" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="text-right">Action</th>
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
                ajax: '{!! route('manage.permissions.index') !!}',
                createdRow: function( row, data, dataIndex ) { $( row ).find('td:eq(2)').attr('class', 'text-right'); },
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    },
                ]

            });

        });

    </script>
@endsection
