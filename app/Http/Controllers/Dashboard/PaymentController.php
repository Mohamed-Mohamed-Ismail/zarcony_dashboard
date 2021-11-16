<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $users = User::all();
        $payments = Payment::filter($request->all())->paginate(10);

        return view('payments.index', [
            'payments' => $payments,
            'users' => $users
        ]);
    }


}
