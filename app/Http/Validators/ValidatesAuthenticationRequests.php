<?php

namespace App\Http\Validators;

use Illuminate\Http\Request;

trait ValidatesAuthenticationRequests
{
    /**
     * Validate login request input
     *
     * @param  Request $request
     * @throws \Illuminate\Auth\Access\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
            'user_type' => 'required|in:customer,admin',
        ]);
    }

    /**
     * Validate register request input
     *
     * @param  Request $request
     * @throws \Illuminate\Auth\Access\ValidationException
     */
    protected function validateRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200|alpha_num',
            'email'    => 'required|email|max:255|unique:user,email',
            'password' => 'required|min:8',
            'user_type' => 'required|in:customer,admin'
        ]);
    }
}
