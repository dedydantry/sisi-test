<?php

namespace App\Traits;

use App\Models\{ErrorLog as ErroModel};

trait ErrorLog
{
    public function ErrorLog($params)
    {
        try {
            ErroModel::create([
                'user_id' => auth()->user()->id,
                'modules' => $params['modules'],
                'controller' => $params['controller'],
                'function' => $params['function'],
                'error_line' =>  $params['error_line'],
                'error_message' =>  $params['error_message'],
                'status' =>  'success'
            ]);
        } catch (\Exception $e) {
            ErroModel::create([
                'user_id' => auth()->user()->id,
                'modules' => 'ErrorLog',
                'controller' => null,
                'function' => 'ErrorLog',
                'error_line' => 12,
                'error_message' =>  $e->getMessage(),
                'status' =>  'success'
            ]);
        }
    }
}