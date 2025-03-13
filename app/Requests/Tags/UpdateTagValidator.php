<?php
namespace App\Requests\Tags;

use App\Requests\BaseRequestFormApi;

class UpdateTagValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        $id = $this->request()->segment(3);
        return [
            'name' => 'required|string|min:3|max:50|unique:tag,name,'.$id.'id' 
        ];
    }

    public function authorized()
    {
        return true;
    }
}