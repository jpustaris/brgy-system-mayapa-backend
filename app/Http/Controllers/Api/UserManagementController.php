<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Residents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    //     $this->authorizeResource(Order::class, 'order');
    // }

    public function index()
    {
        $users = User::with(['user_role'])
        ->where("is_active",1)
        ->whereNot("role_id",1)
        ->get();
        return response()->json(['status' => 'success', 'data' => $users], 200);
    }
    

    
    public function changePassword(Request $request)
    {
        // for change password
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Order::class);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'role_id' => 'required|int',
            'email' => 'required|string|email',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $user = User::create($validator->validated());

        return response()->json(['status' => 'success', 'data' => $user], 201);
    }

    // public function show(Order $order)
    // {
    //     return response()->json(['status' => 'success', 'data' => $order], 200);
    // }

    public function updateByID(Request $request,$id)
    {
        $temp = User::where('id', $id)
        ->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
        $users = User::all();
        if ($temp) {
            return response()->json(['status' => 'success', 'data' => $users], 200);
        }else{
            return response()->json(['status' => 'error'],    422);
        }
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $order);

        $temp = User::where('id', $id)
        ->update([
            'is_active' => 0,
        ]);

        $users = User::all();

        if ($temp) {
            return response()->json(['status' => 'success', 'data' => $users], 200);
        }else{
            return response()->json(['status' => 'error'],    422);
        }
    }
}
