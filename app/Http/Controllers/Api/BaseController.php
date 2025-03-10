<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($response,$status,$code)
    {
      return response()->json(['data'=>$response,'status'=>$status,'code'=>$code]);
    }
}
