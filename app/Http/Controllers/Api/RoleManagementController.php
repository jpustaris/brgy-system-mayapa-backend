<?php

namespace App\Http\Controllers\Api;

use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RoleManagementController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    //     $this->authorizeResource(Order::class, 'order');
    // }

    public function index()
    {
        $users = UserRole::all();
        return response()->json(['status' => 'success', 'data' => $users], 200);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $role = UserRole::create($validator->validated());

        return response()->json(['status' => 'success', 'data' => $role], 201);
    
    }

    public function update(Request $request,$id)
    {
        $temp = UserRole::where('id', $id)
        ->update([
            'role_name' => $request->role_name,
        ]);
        $roles = UserRole::all();
        if ($temp) {
            return response()->json(['status' => 'success', 'data' => $roles], 200);
        }else{
            return response()->json(['status' => 'error'],    422);
        }
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $order);

        $temp = UserRole::where('id', $id)
        ->update([
            'is_active' => 0,
        ]);

        $roles = UserRole::all();

        if ($temp) {
            return response()->json(['status' => 'success', 'data' => $roles], 200);
        }else{
            return response()->json(['status' => 'error'],    422);
        }
    }
    
}
