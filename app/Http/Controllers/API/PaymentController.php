<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;


class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $user = auth()->user();
        $recipient = User::where('id', $request['recipient_id'])->firstOrFail();
        $last_2hours = Payment::where('user_id', $user->id)
            ->where('created_at', '<', Carbon::now())
            ->where('created_at', '>', Carbon::now()
                ->subHours('2')->toDateTimeString())
            ->sum('amount');

        if ($this->IsSameUser($user, $recipient)) {
            return response()->json([
                "message" => "error",
                "response" => "Sorry, You can not do this "
            ], 400);
        }
        if ($this->isLimitExceed($request, $last_2hours)) {

            return response()->json([
                "message" => "error",
                "response" => "Sorry,You exceed your limit"
            ], 400);
        }
        if ($this->hasNoBalance($user, $request)) {

            return response()->json([
                "message" => "error",
                "response" => "Your amount is not enough"
            ], 400);

        }
        $user->balance = $user->balance - $request->amount;
        $recipient->balance = $recipient->balance + $request->amount;
        $user->save();
        $recipient->save();
        $payment = Payment::create([
            'payment_number' => 'PAY-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'recipient_id' => $request['recipient_id'],
            'amount' => $request['amount']
        ]);

        return response()->json([
            "message" => "success",
            "response" => $payment
        ], 201);

    }

    /**
     * @param StorePaymentRequest $request
     * @param $last_2hours
     * @return bool
     */
    public function isLimitExceed(StorePaymentRequest $request, $last_2hours): bool
    {
        return $request->amount > 200 || ($last_2hours + $request->amount) > 200;
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @param StorePaymentRequest $request
     * @return bool
     */
    public function hasNoBalance(?\Illuminate\Contracts\Auth\Authenticatable $user, StorePaymentRequest $request): bool
    {
        return $user->balance < $request->amount;
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @param $recipient
     * @return bool
     */
    public function IsSameUser(?\Illuminate\Contracts\Auth\Authenticatable $user, $recipient): bool
    {
        return $user->id == $recipient->id;
    }
}
