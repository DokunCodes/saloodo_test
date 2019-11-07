<?php

namespace App\Http\Validators;

use Illuminate\Http\Request;

trait ValidatesAdminRequests
{
    /**
     * Validate update user request input
     *
     * @param  Request $request
     * @throws \Illuminate\Auth\Access\ValidationException
     */
    protected function validateProduct(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:100',
            'price'    => 'required|numeric',
            'description' => 'required|string',
            'discount'    => 'required|numeric',
            'discount_type'  => 'required|in:amount,percentage',
        ]);
    }

    protected function validateBundle(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:100',
            'price'    => 'required|numeric',
            'description' => 'string',
            'products' => 'required|array'

        ]);
    }




}
