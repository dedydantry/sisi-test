<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Traits\{UserActivity,ErrorLog};

class MenuController extends Controller
{
    use UserActivity,ErrorLog;

    public function index()
    {
        try {
            $this->UserActivity([
                'menu' => 'Menu',
                'description' => 'Open menu page',
                'status' => 'success'
            ]);
            return MenuResource::collection(
                Menu::with('parent')->get()
            );
        } catch (\Exception $e) {
            $this->ErrorLog([
                'modules' => 'Menu',
                'controller' => 'MenuController',
                'function' => 'index',
                'error_line' => '26',
                'error_message' => $e->getMessage()
            ]);
            return response()->json([]);
        }
        
    }
}
