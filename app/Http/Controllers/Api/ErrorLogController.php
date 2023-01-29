<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorLogResource;
use App\Models\ErrorLog;

class ErrorLogController extends Controller
{
    public function index()
    {
        return ErrorLogResource::collection(
            ErrorLog::with('user')->get()
        );
    }
}
