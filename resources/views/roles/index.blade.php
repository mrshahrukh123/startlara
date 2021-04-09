@extends('layouts.main')
@section('content')
    <div class="float-left"><h1 class="mt-4">Roles</h1></div>
    <div class="float-right">
        @can('create-role')
            <a class="mt-4 btn btn-primary" href="{{route('manage.roles.create')}}">Add New</a>
        @endcan
    </div>
    <div class="clearfix"></div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
    @include('partials.message')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            All Roles
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered list-datatables the-table" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Permissions</th>
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
                ajax: '{!! route('manage.roles.index') !!}',
                createdRow: function( row, data, dataIndex ) { $( row ).find('td:eq(3)').attr('class', 'text-right'); },
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
                        data: 'permissions',
                        name: 'permissions',
                        orderable: false,
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
