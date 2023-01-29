<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\{UserActivity,ErrorLog};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator};
use Illuminate\Support\Str;

class UserController extends Controller
{
    use UserActivity, ErrorLog;

    public function index()
    {
        try {
            $this->UserActivity([
                'menu' => 'User',
                'description' => 'Open user page',
                'status' => 'success'
            ]);
            return UserResource::collection(
                User::get()
            );
        } catch (\Exception $e) {
            $this->ErrorLog([
                'modules' => 'User',
                'controller' => 'UserController',
                'function' => 'index',
                'error_line' => '30',
                'error_message' => $e->getMessage()
            ]);
            return response()->json([]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email', 
                'password' => 'required|string',
                'name' => 'required|string',
                'phone' => 'required|string',
                'waNumber' => 'required|string',
                'pin' => 'required|string',
            ]);
    
            if ($validator->fails()) return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    
            $params = [
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password), // password
                'remember_token' => Str::random(10),
                'user_name' => Str::slug($request->name), //str_replace(' ', '', $request->name),
                'no_hp' => $request->phone,
                'wa' => $request->waNumber,
                'pin' => $request->pin,
                'status_user' => 'active',
            ];

            $user = User::create($params);

            $this->UserActivity([
                'menu' => 'User',
                'description' => 'Create new user '. $user->id,
                'status' => 'success'
            ]);
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (\Exception $e) {
            $this->ErrorLog([
                'modules' => 'User',
                'controller' => 'UserController',
                'function' => 'store',
                'error_line' => '80',
                'error_message' => $e->getMessage()
            ]);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email', 
                'name' => 'required|string',
                'phone' => 'required|string',
                'waNumber' => 'required|string',
                'pin' => 'required|string',
            ]);

            if ($validator->fails()) return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
            $user = User::find($id);

            if(!$user) return response()->json([
                'status' => false,
                'message' => 'Invalid user'
            ]);

            $user->name = $request->name;
            $user->name = $request->name;
            $user->user_name = Str::slug($request->name);
            $user->no_hp = $request->phone;
            $user->wa = $request->waNumber;
            $user->pin = $request->pin;
            $user->save();

            $this->UserActivity([
                'menu' => 'User',
                'description' => 'Update user '. $user->id ,
                'status' => 'success'
            ]);

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (\Exception $e) {
            $this->ErrorLog([
                'modules' => 'User',
                'controller' => 'UserController',
                'function' => 'update',
                'error_line' => '126',
                'error_message' => $e->getMessage()
            ]);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if($user){
                $user->delete();

                $this->UserActivity([
                    'menu' => 'User',
                    'description' => 'Delete user '. $id ,
                    'status' => 'success'
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Has deleted'
            ]);
        } catch (\Exception $e) {
            $this->ErrorLog([
                'modules' => 'User',
                'controller' => 'UserController',
                'function' => 'destroy',
                'error_line' => '165',
                'error_message' => $e->getMessage()
            ]);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function setMenu(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'menus' => 'required', 
            ]);
    
            if ($validator->fails()) return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
    
            $user = User::find($id);
    
            if(!$user) return response()->json([
                'status' => false,
                'message' => 'Invalid user'
            ]);
    
            $user->menus()->detach();
            $user->menus()->attach($request->menus, [
                'update_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $this->UserActivity([
                'menu' => 'User',
                'description' => 'Assing menu user '. $user->id ,
                'status' => 'success'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Menu has assigned to user'
            ]);
        } catch (\Exception $e) {
            $this->ErrorLog([
                'modules' => 'User',
                'controller' => 'UserController',
                'function' => 'setMenu',
                'error_line' => '213',
                'error_message' => $e->getMessage()
            ]);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
