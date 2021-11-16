@extends('layouts.app')
@section('title')
   Home
@endsection
@section('content')
@section('toolbar')
    <div class="d-flex align-items-center me-3">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">  Home</h1>
        <span class="h-20px border-gray-200 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
            </li>


        </ul>
    </div>
@endsection
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            System Log
        </h3>

    </div>
    <!--begin::Form-->

    <div class="card-body">


        <table id="kt_datatable_example_3" class="table table-striped table-row-bordered gy-5 gs-7">
            <thead>
            <tr class="">
                <th >No</th>
                <th >Log Name</th>
                <th >Description</th>
                <th >Subject Type</th>
                <th >Subject Id</th>
                <th >Causer Type</th>
                <th >Causer Id</th>

                <th >Date</th>
            </tr>
            </thead>

        </table>
    </div>

</div>


@section('js')

    @include('layouts.datatable')

    <script>
        var table = $('#kt_datatable_example_3').DataTable({

            "paging": true,


            ajax: {
                url: "{{ route('activiesList') }}",
                type: "GET",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'log_name', name: 'log_name'},
                {data: 'description', name: 'description'},
                {data: 'subject_type', name: 'subject_type'},
                {data: 'subject_id', name: 'subject_id'},
                {data: 'causer_type', name: 'causer_type'},
                {data: 'causer_id', name: 'causer_id'},
                {data: 'created_at', name:'created_at'},


            ],


        });



    </script>
@endsection

@endsection
