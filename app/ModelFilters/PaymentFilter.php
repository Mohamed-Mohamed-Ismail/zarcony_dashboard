<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PaymentFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */

    public function paymentNumber($number)
    {
        return $this->where('payment_number', $number);
    }
    public function userId($user)
    {
        return $this->where('user_id', $user);
    }
    public function reciptientId($user)
    {
        return $this->where('recipient_id', $user);
    }
}
