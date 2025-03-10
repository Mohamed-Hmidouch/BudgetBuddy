<?php
namespace App\Requests\Users;

use App\Requests\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|min:6|max:50|unique:users',
            'password' => 'required|min:8|max:50|confirmed',
        ];
    }

    public function authorized()
    {
        return true;
    }
}
