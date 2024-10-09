<?php

namespace App\Http\Controllers\Api;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    //     $this->authorizeResource(Order::class, 'order');
    // }

    public function index()
    {
        $residents = Resident::all();
        foreach ($residents as $resident => $value) {
            $value->display_name = $value->first_name;
            $value->display_name = $value->middle_name == null ? $value->display_name : $value->display_name . " " . $value->middle_name;
            $value->display_name = $value->last_name == null ? $value->display_name : $value->display_name . " " . $value->last_name;
        }
        return response()->json(['status' => 'success', 'data' => $residents], 200);
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Order::class);

        $validator = Validator::make($request->all(), [
            // 'product_id' => 'required|exists:products,id',
            // 'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $resident = Resident::create($validator->validated());

        return response()->json(['status' => 'success', 'data' => $resident], 201);
    }

    public function show(Resident $resident)
    {
        return response()->json(['status' => 'success', 'data' => $resident], 200);
    }

    public function fetchResidentByID($id)
    {
        $resident_details = Resident::find($id);
        return response()->json(['status' => 'success', 'data' => $resident_details], 200);
    }

    public function fetchHWs()
    {
        $HWs = Resident::where("is_HW",1)
        ->get();
        return response()->json(['status' => 'success', 'data' => $HWs], 200);
    }

    public function fetchPWDs()
    {
        $seniors = Resident::where("is_PWD" ,1)
        ->where('is_deceased',0)
        ->get();
        return response()->json(['status' => 'success', 'data' => $seniors], 200);
    }

    public function fetchSeniors()
    {
        $seniors = Resident::where("age",'>=' ,60)
        ->where('is_deceased',0)
        ->get();
        return response()->json(['status' => 'success', 'data' => $seniors], 200);
    }

    public function fetchAliveResidents()
    {
        $alive = Resident::where('is_deceased',0)
        ->get();
        return response()->json(['status' => 'success', 'data' => $alive], 200);
    }

    public function update(Request $request, Resident $resident)
    {
        // $this->authorize('update', $order);

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $resident->update($validator->validated());

        return response()->json(['status' => 'success', 'data' => $resident], 200);
    }

    public function destroy(Resident $resident)
    {
        // $this->authorize('delete', $order);

        $resident->delete();

        return response()->json(['status' => 'success', 'message' => 'Order deleted successfully'], 200);
    }
}
