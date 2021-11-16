@extends('layouts.app')
@section('title')
    History Of User - {{$user->name}}
@endsection
@section('content')
@section('toolbar')
    <div class="d-flex align-items-center me-3">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">  History Of User - {{$user->name}}</h1>
        <span class="h-20px border-gray-200 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{route('users.index')}}" class="text-muted text-hover-primary">Users</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">  History Of User - {{$user->name}}</li>

        </ul>
    </div>
@endsection
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            History Of User - {{$user->name}}
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-warning" href="{{route('users.index')}}">Back To Users</a>

        </div>
    </div>
    <!--begin::Form-->
    @include('layouts.includes.alerts.errors')
    @include('layouts.includes.alerts.success')
    @include('layouts.Modals.deleteModal')
    <div class="card-body" >
        <input type="hidden" id="{{$user->id}}" class="user_id">
        <table id="kt_datatable_example_3" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
            <tr class="">
                <th style="width: 5%">No</th>
                <th style="width: 15%">Pay_Number</th>
                <th style="width: 10%">Recipient </th>
                <th style="width: 10%">Amount</th>
                <th style="width: 10%">Date</th>


            </tr>
            </thead>

        </table>
    </div>


</div>

@section('js')

@include('layouts.datatable')

    <script>
        var user_id  = $('.user_id').attr('id');

        var table = $('#kt_datatable_example_3').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/historyList/" + user_id,
                type: "GET",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'payment_number', name: 'payment_number'},
                {data: 'recipient_id', name: 'recipient_id'},
                {data: 'amount', name: 'amount'},
                {data: 'created_at', name: 'created_at'},



            ],


        });



</script>
@endsection

@endsection
