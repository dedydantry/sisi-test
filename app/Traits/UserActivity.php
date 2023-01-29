<?php

namespace App\Traits;

use App\Models\{Activity,Menu};

trait UserActivity
{
    public function UserActivity($params)
    {
        try {
            $menuId = '';
            if($params['menu']){
                $menu = Menu::where('menu_name', $params['menu'])->first();
                $menuId = $menu->id;
            }
            if($menu){
                Activity::create([
                    'user_id' => auth()->user()->id,
                    'menu_id' => $menuId,
                    'description' => $params['description'],
                    'status' => 'success',
                ]);
            }
           
        } catch (\Exception $e) {
            //throw $th;
            throw $e;
        }
    }
}