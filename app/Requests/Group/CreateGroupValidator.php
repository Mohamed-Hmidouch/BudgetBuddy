<?php
namespace App\Requests\Group;

use App\Requests\BaseRequestFormApi;

class CreateGroupValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|min:3|max:50',
            'currency' => 'required|string|size:2',
            'users' => 'required|array|min:1',
            'users.*' => 'integer|exists:users,id'
        ];
    }

    public function authorized()
    {
        return true;
    }
}