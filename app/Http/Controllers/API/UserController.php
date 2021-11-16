<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserResource as UserResource;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class UserController extends Controller
{
    public function getUsers()
    {
        $response = [
            'users' => UserResource::Collection(User::all()),
        ];
        return response($response, 200);
    }

    public function profile()
    {
        $user = auth()->user();

        $response = [
            'user' => new UserResource($user),
        ];
        return response($response, 200);
    }

    public function transactions()
    {
        $user = auth()->user();
        $inTransactions = Payment::where('recipient_id', $user->id)->get();
        $response = [
            'user' => new UserResource($user->load('payments')),
            'in_transactions' => PaymentResource::collection($inTransactions)
        ];
        return response($response, 200);
    }
}
