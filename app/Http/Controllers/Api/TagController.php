<?php

namespace App\Http\Controllers\Api;

use Log;
use App\Models\User;
use App\Models\Api\Tag;
use App\Services\TagService;
use Illuminate\Support\Facades\Auth;
use App\Requests\Tags\CreateTagValidator;
use App\Requests\Tags\UpdateTagValidator;
use App\Http\Resources\TagResource;
/**
 * @OA\Info(title="Tag API", version="1.0.0")
 */
class TagController extends BaseController
{
    public $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    
/**
     * @OA\Post(
     *     path="/api/tag",
     *     summary="Créer un nouveau tag",
     *     tags={"Tags"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="example_tag")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Tag créé avec succès"),
     *     @OA\Response(response=406, description="Erreurs de validation")
     * )
     */
    
    public function store(CreateTagValidator $createTagValidator)
    {
        if(!empty($createTagValidator->getErrors()))
        {
            return $this->sendResponse($createTagValidator->getErrors(), false, 406);
        }
        $data = $createTagValidator->request()->all();
        $data['user_id'] = Auth::user()->id;
        $response = $this->tagService->createTag($data);
        return $this->sendResponse(new TagResource($response), true, 201);
    }

/**
     * @OA\Delete(
     *     path="/api/tag/{id}",
     *     summary="Supprimer un tag",
     *     tags={"Tags"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Tag supprimé avec succès")
     * )
     */

    public function destroy($id)
    {
        $this->tagService->delete($id);
        return $this->sendResponse(new TagResource([]), true, 200);
    }

/**
     * @OA\Put(
     *     path="/api/tag/{id}",
     *     summary="Mettre à jour un tag",
     *     tags={"Tags"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="updated_tag")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Tag mis à jour avec succès"),
     *     @OA\Response(response=406, description="Erreurs de validation")
     * )
     */

    public function update($id, UpdateTagValidator $updateTagValidator)
    {
        if(!empty($updateTagValidator->getErrors()))
        {
            return $this->sendResponse($updateTagValidator->getErrors(), false, 406);
        }
        $data = $updateTagValidator->request()->all();
        $data['user_id'] = Auth::user()->id;
        $response = $this->tagService->updateTag($id, $data);
        return $this->sendResponse(new TagResource($response), true, 201);
    }
}
