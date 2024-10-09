<?php

namespace App\Http\Controllers\Api;

use App\Models\Blotter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BlotterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
        // $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        $blotters = Blotter::with(['complainant','encoder'])->get();
        return response()->json(['status' => 'success', 'data' => $blotters], 200);
    }

    public function blottersByUser()
    {
        $blotters = Blotter::where("encoded_by",Auth::user()->id)->get();
        return response()->json(['status' => 'success', 'data' => $blotters], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'complainant' => 'required|int|max:255',
            'defendant' => 'required|string|max:50',
            // 'brgy_case_number' => 'required|string|max:20',
            'complaint' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
        $blotter = new Blotter;
        $blotter->complainant = $request->complainant;
        // $blotter->brgy_case_number = $request->brgy_case_number;
        $blotter->brgy_case_no = $request->brgy_case_no;
        $blotter->defendant = $request->defendant;
        $blotter->complaint = $request->complaint;
        $blotter->note = $request->note;
        $blotter->encoder = Auth::user()->id;
        $blotter->save();
        // $blotter = Blotter::create($validator->validated());


        return response()->json(['status' => 'success', 'data' => $blotter], 201);
    }

    public function show(Blotter $blotter)
    {
        return response()->json(['status' => 'success', 'data' => $blotter], 200);
    }

    public function fetchBlotterByID($id)
    {
        $blotter_details = Blotter::find($id);
        return response()->json(['status' => 'success', 'data' => $blotter_details], 200);
    }

    public function updateByID(Request $request,$id)
    {
        $temp = Blotter::where('id', $id)
        ->update([
            'complaint' => $request->complaint,
            'note' => $request->note,
        ]);
        $blotters = Blotter::all();
        if ($temp) {
            return response()->json(['status' => 'success', 'data' => $blotters], 200);
        }else{
            return response()->json(['status' => 'error'],    422);
        }
    }

    public function destroy($id)
    {
        $temp = Blotter::where('id', $id)
        ->update([
            'is_deleted' => 1,
        ]);

        $blotters = Blotter::all();

        if ($temp) {
            return response()->json(['status' => 'success', 'data' => $blotters], 200);
        }else{
            return response()->json(['status' => 'error'],    422);
        }
    }
}
