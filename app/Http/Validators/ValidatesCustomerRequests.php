<?php

namespace App\Http\Validators;

use Illuminate\Http\Request;

trait ValidatesCustomerRequests
{
    /**
     * Validate login request input
     *
     * @param  Request $request
     * @throws \Illuminate\Auth\Access\ValidationException
     */
    protected function validateOrder(Request $request)
    {
        $this->validate($request, [
            'product'    => 'required|array'
        ]);
    }

    /**
     * Validate register request input
     *
     * @param  Request $request
     * @throws \Illuminate\Auth\Access\ValidationException
     */
    protected function validateGetOrder(Request $request)
    {
        $this->validate($request, [
            'order_ref'    => 'required|string'
        ]);
    }
}
