<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function __invoke(Request $request)
    {
        return response()->success(ProfileResource::make($request->user()));
    }
}
