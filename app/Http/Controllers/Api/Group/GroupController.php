<?php

namespace App\Http\Controllers\Api\Group;

use Illuminate\Http\Request;
use App\Services\GroupService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\GroupResource;
use App\Http\Controllers\Api\BaseController;
use App\Requests\Group\CreateGroupValidator;

class GroupController extends BaseController
{

    public $groupService;
    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createGroupValidator $createGroupValidator)
    {
        if(!empty($createGroupValidator->getErrors()))
        {
            return $this->sendResponse($createGroupValidator->getErrors(), false, 406);
        }
        $data = $createGroupValidator->request()->all();
        $data['user_id'] = Auth::user()->id;
        $response = $this->groupService->createGroup($data);
        return $this->sendResponse(new GroupResource($response), true, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
