<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Http\Controllers\Controller;


class ActivityController extends Controller
{
    public function index()
    {
        return ActivityResource::collection(
            Activity::with('user')->get()
        );
    }
}
