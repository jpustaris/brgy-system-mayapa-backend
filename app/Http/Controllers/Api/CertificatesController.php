<?php

namespace App\Http\Controllers\Api;

// use App\Models\Blotter;
use App\Models\Certificate;
use App\Models\BrgyOfficial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class CertificatesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
        // $this->authorizeResource(Category::class, 'category');
    }

    public function fetchBRGYBusinessPermit()
    {
        $certificates = Certificate::where('certificate_type_id',1)->get();
        return response()->json(['status' => 'success', 'data' => $certificates], 200);
    }

    public function fetchBRGYClearance()
    {
        $certificates = Certificate::where('certificate_type_id',2)->get();
        return response()->json(['status' => 'success', 'data' => $certificates], 200);
    }

    public function fetchBRGYGoodMoral()
    {
        $certificates = Certificate::where('certificate_type_id',3)->get();
        return response()->json(['status' => 'success', 'data' => $certificates], 200);
    }

    public function fetchBRGYIndigency()
    {
        $certificates = Certificate::where('certificate_type_id',4)->get();
        return response()->json(['status' => 'success', 'data' => $certificates], 200);
    }

    public function fetchBRGYResidency()
    {
        $certificates = Certificate::where('certificate_type_id',5)->get();
        return response()->json(['status' => 'success', 'data' => $certificates], 200);
    }

    public function fetchBarangayOfficials()
    {
        $brgy_officials = BrgyOfficial::first();
        return response()->json(['status' => 'success', 'data' => $brgy_officials], 200);
    }

    

    public function storeBRGYResidency(Request $request)
    {

        try {
            $validated = $request->validate([
                'certificate_type_id' => 'required|integer',
                'fullname' => 'required|string',
                'gender' => 'required|string',            
                'age' => 'required|integer',
                'address' => 'required|string',            
                'living_in_brgy_since' => 'required|date',
                'purpose' => 'required|string',
            ]);
    
            // Get the current year from the timestamp
            $currentYear = Carbon::now()->year;
    
            // Use a transaction to avoid race conditions
            return DB::transaction(function () use ($validated, $currentYear) {
                // Get the last control number for the given certificate type and year from the created_at column
                $lastControlNumber = Certificate::where('certificate_type_id', $validated['certificate_type_id'])
                                            ->whereYear('created_at', $currentYear)
                                            ->max('control_number');
    
                // Increment the control number or start at 1 if none exists for the year
                $newControlNumber = $lastControlNumber ? $lastControlNumber + 1 : 1;
    
                // Create the new certificate
                $certificate = Certificate::create([
                    'created_by_user_id' => Auth::user()->id,
                    'control_number' => $newControlNumber,
                    'certificate_type_id' => $validated['certificate_type_id'],
                    'fullname' => $validated['fullname'],
                    'age' => $validated['age'],
                    'gender' => $validated['gender'],
                    'address' => $validated['address'],
                    'living_in_brgy_since' => $validated['living_in_brgy_since'],
                    'purpose' => $validated['purpose'],
    
                ]);
    
                return response()->json([
                    'message' => 'Certificate created successfully', 
                    'data' => $certificate,
                    'lastControlNumber' => $lastControlNumber,
                    'newControlNumber' => $newControlNumber,
                ]);
            });
        } catch (\Throwable $th) {
            throw $th;
        }        
    }

    public function storeBRGYIndigency(Request $request)
    {
        try {
            $validated = $request->validate([
                'certificate_type_id' => 'required|integer',
                'fullname' => 'required|string',
                'gender' => 'required|string',            
                'age' => 'required|integer',
                'address' => 'required|string',            
                'purpose' => 'required|string',
            ]);
    
            // Get the current year from the timestamp
            $currentYear = Carbon::now()->year;
    
            // Use a transaction to avoid race conditions
            return DB::transaction(function () use ($validated, $currentYear) {
                // Get the last control number for the given certificate type and year from the created_at column
                $lastControlNumber = Certificate::where('certificate_type_id', $validated['certificate_type_id'])
                                            ->whereYear('created_at', $currentYear)
                                            ->max('control_number');
    
                // Increment the control number or start at 1 if none exists for the year
                $newControlNumber = $lastControlNumber ? $lastControlNumber + 1 : 1;
    
                // Create the new certificate
                $certificate = Certificate::create([
                    'created_by_user_id' => Auth::user()->id,
                    'control_number' => $newControlNumber,
                    'certificate_type_id' => $validated['certificate_type_id'],
                    'fullname' => $validated['fullname'],
                    'age' => $validated['age'],
                    'gender' => $validated['gender'],
                    'address' => $validated['address'],
                    'purpose' => $validated['purpose'],
    
                ]);
    
                return response()->json([
                    'message' => 'Certificate created successfully', 
                    'data' => $certificate,
                    'lastControlNumber' => $lastControlNumber,
                    'newControlNumber' => $newControlNumber,
                ]);
            });
        } catch (\Throwable $th) {
            throw $th;
        }        
    }


    // public function blottersByUser()
    // {
    //     $blotters = Blotter::where("encoded_by",Auth::user()->id)->get();
    //     return response()->json(['status' => 'success', 'data' => $blotters], 200);
    // }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'complainant' => 'required|int|max:255',
    //         'defendant' => 'required|string|max:50',
    //         // 'brgy_case_number' => 'required|string|max:20',
    //         'complaint' => 'required|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
    //     }
    //     $blotter = new Blotter;
    //     $blotter->complainant = $request->complainant;
    //     // $blotter->brgy_case_number = $request->brgy_case_number;
    //     $blotter->brgy_case_no = $request->brgy_case_no;
    //     $blotter->defendant = $request->defendant;
    //     $blotter->complaint = $request->complaint;
    //     $blotter->note = $request->note;
    //     $blotter->encoder = Auth::user()->id;
    //     $blotter->save();
    //     // $blotter = Blotter::create($validator->validated());


    //     return response()->json(['status' => 'success', 'data' => $blotter], 201);
    // }

    // public function show(Blotter $blotter)
    // {
    //     return response()->json(['status' => 'success', 'data' => $blotter], 200);
    // }

    // public function fetchBlotterByID($id)
    // {
    //     $blotter_details = Blotter::find($id);
    //     return response()->json(['status' => 'success', 'data' => $blotter_details], 200);
    // }

    // public function updateByID(Request $request,$id)
    // {
    //     $temp = Blotter::where('id', $id)
    //     ->update([
    //         'complaint' => $request->complaint,
    //         'note' => $request->note,
    //     ]);
    //     $blotters = Blotter::all();
    //     if ($temp) {
    //         return response()->json(['status' => 'success', 'data' => $blotters], 200);
    //     }else{
    //         return response()->json(['status' => 'error'],    422);
    //     }
    // }

    // public function destroy($id)
    // {
    //     $temp = Blotter::where('id', $id)
    //     ->update([
    //         'is_deleted' => 1,
    //     ]);

    //     $blotters = Blotter::all();

    //     if ($temp) {
    //         return response()->json(['status' => 'success', 'data' => $blotters], 200);
    //     }else{
    //         return response()->json(['status' => 'error'],    422);
    //     }
    // }
}
