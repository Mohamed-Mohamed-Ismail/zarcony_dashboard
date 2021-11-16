@extends('layouts.app')
@section('title')
    Payments
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
            <li class="breadcrumb-item text-dark"> Payments</li>

        </ul>
    </div>
@endsection
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Payments
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-warning" href="{{route('admin.dashboard')}}">Back To Home</a>

        </div>
    </div>
    <!--begin::Form-->
    @include('layouts.includes.alerts.errors')
    @include('layouts.includes.alerts.success')

    <div class="card-body">
        <form action="{{route('payments.index')}}" class="row g-3" method="get">
            <div class="col-auto">

                <input type="text" name="payment_number" class="form-control" class="form-control"
                       placeholder="Payment Number">
            </div>
            <div class="col-auto">
                <select class="form-select" name="userId" aria-label="Select example">
                    <option value="">Choose User</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select class="form-select" name="recipientId" aria-label="Select example">
                    <option value=" ">Choose Recipient</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3"> Filter</button>
            </div>
        </form>

        <table id="kt_datatable_example_3" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
            <tr class="">
                <th style="width: 5%">No</th>
                <th style="width: 20%">Payment Number</th>
                <th style="width: 20%">User_id</th>
                <th style="width:20%">Recipient_id</th>
                <th style="width: 15%">Amount</th>
                <th style="width: 20%">Date</th>
            </tr>
            </thead>
            <tbody>
            <?php $index = 0;?>
            @forelse($payments as $payment)
                <?php $index++;?>

                <tr>
                    <td>{{$index}}</td>
                    <td>{{ $payment ->payment_number}}</td>
                    <td>{{ $payment ->user_id }}</td>
                    <td>{{ $payment ->recipient_id }}</td>
                    <td>{{ $payment ->amount }}</td>
                    <td>{{ date_format($payment->created_at, 'jS M Y') }}</td>

                </tr>
            @empty
                <tr>
                    <h1 class="text-center">No Data To View </h1>
                <tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $payments->links() }}
</div>


@endsection
