<?php

namespace App\Http\Controllers\Api;

use Log;
use App\Models\User;
use App\Models\Api\Tag;
use App\Services\TagService;
use Illuminate\Support\Facades\Auth;
use App\Requests\Tags\CreateTagValidator;
use App\Requests\Tags\UpdateTagValidator;

class TagController extends BaseController
{
    public $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    
    public function store(CreateTagValidator $createTagValidator)
    {
        if(!empty($createTagValidator->getErrors()))
        {
            return $this->sendResponse($createTagValidator->getErrors(),false,406);
        }
       $data = $createTagValidator->request()->all();
       $data['user_id']=Auth::user()->id;
       $response = $this->tagService->createTag($data);
       return $this->sendResponse($response,true,201);
        }

    public function destroy($id)
    {
       $this->tagService->delete($id);
    return $this->sendResponse('Tag deleted successfully', true, 200);
    }

    public function update($id,UpdateTagValidator $updateTagValidator)
    {
        if(!empty($updateTagValidator->getErrors()))
        {
            return $this->sendResponse($updateTagValidator->getErrors(),false,406);
        }
       $data = $updateTagValidator->request()->all();
       $data['user_id']=Auth::user()->id;
       $response = $this->tagService->updateTag($id,$data);
       return $this->sendResponse($response,true,201);
    }
}
