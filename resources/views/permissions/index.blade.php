@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Permissions</h1>
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
                        <th scope="col">Page Key</th>
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
                        data: 'page_key',
                        name: 'page_key'
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
