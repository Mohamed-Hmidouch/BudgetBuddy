<?php
namespace App\Requests\Tags;

use App\Requests\BaseRequestFormApi;

class CreateTagValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50' 
        ];
    }

    public function authorized()
    {
        return true;
    }
}