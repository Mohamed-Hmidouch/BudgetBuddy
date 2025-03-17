<?php
namespace App\Requests\Group;

use App\Requests\BaseRequestFormApi;

class UpdateGroupValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        $id = $this->request()->segment(3);
        return [
            'name' => 'required|string|min:3|max:50|unique:groups,name,'.$id.',id',
            'currency' => 'required|string|max:3',
            'users' => 'sometimes|array',
            'users.*' => 'exists:users,id'
        ];
    }

    public function authorized()
    {
        return true;
    }
}