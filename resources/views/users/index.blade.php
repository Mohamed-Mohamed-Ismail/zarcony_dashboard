@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
@section('toolbar')
    <div class="d-flex align-items-center me-3">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Users</h1>
        <span class="h-20px border-gray-200 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark"> Manage User</li>

        </ul>
    </div>
@endsection
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Manage User
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-warning" href="{{route('users.create')}}">Add New User</a>

        </div>
    </div>
    <!--begin::Form-->
    @include('layouts.includes.alerts.errors')
    @include('layouts.includes.alerts.success')
    @include('layouts.Modals.deleteModal')
    <div class="card-body" >
        <table id="kt_datatable_example_3" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
            <tr class="">
                <th style="width: 5%">No</th>
                <th style="width: 20%">Name</th>
                <th  style="width:20%">Email</th>
                <th style="width: 10%" >Balance</th>
                <th style="width: 5%">History</th>
                <th style="width: 25%">Action</th>

            </tr>
            </thead>

        </table>
    </div>


</div>

@section('js')

@include('layouts.datatable')
    <?php
    $editUrl = url('admin/users/');
    ?>
    <script>
        var table = $('#kt_datatable_example_3').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('userList') }}",
                type: "GET",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'balance', name: 'balance'},
                {
                    data: 'id', searchable: false, render: function (data, data2, type) {
                        const editUrl = '{{$editUrl}}' + '/' + data + '/history';
                        return "<a href=' " + editUrl + "' class='btn btn-success btn-xs'><i class='la la-eye '></i></a>";

                    }
                },
                {data: 'action', name:'action'},


            ],


        });



        var user_id;
        // Delete action
        $(document).on('click', '.deleteButton', function(){
            user_id = $(this).attr('id');
            $('#deleteModal').modal('show');
        });


            $(document).on('click', '#ok_button', function () {
                // ajax delete data to database
                $.ajax({
                    url: "/admin/users/" + user_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "DELETE",
                    success: function (data) {
                        //if success reload ajax table
                        if (data == "success") {
                            $('#deleteModal').modal('hide');
                            window.location.reload();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });



        });
</script>
@endsection

@endsection
