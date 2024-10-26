<?php

namespace App\Http\Controllers\Api;

// use App\Models\Blotter;
use App\Models\SMSBlast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class SMSBlastController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
        // $this->authorizeResource(Category::class, 'category');
    }

    public function fetchBlastMessages()
    {
        $blasts = SMSBlast::with(['creator'])->get();
        return response()->json(['status' => 'success', 'data' => $blasts], 200);
    }

    public function storeBlastMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'member_ids' => 'required|string',
                'member_numbers' => 'required|string',
                'message_content' => 'required|string',
            ]);
    
            // Get the current year from the timestamp
            $currentYear = Carbon::now()->year;
    
            // Use a transaction to avoid race conditions
            return DB::transaction(function () use ($validated, $currentYear) {

                $message = $validated['message_content'];
                $sender_name = "Mayapa's Barangay System";
                $numbers = $validated['member_numbers'];
                // logic for text blast
                $temp = $this->textBlast($message,$sender_name,$numbers);

                $certificate = SMSBlast::create([
                    'created_by_user_id' => Auth::user()->id,
                    'member_ids' => $validated['member_ids'],
                    'member_numbers' => $numbers,
                    'message_content' => $message,
    
                ]);
                return response()->json([
                    'message' => 'Message Blast created successfully', 
                    'data' => $certificate,
                ]);
            });
        } catch (\Throwable $th) {
            throw $th;
        }        
    }

    private function textBlast($message,$sender_name,$numbers)
    {
        $api_path = config('sms.api_path');
        $api_key = config('sms.api_key');
        $data = [
            'api_key' => $api_key,
            'number' => $numbers ,
            'message' => $message ,
            'sendername' => $sender_name
        ];
        Http::post($api_path,$data);
    }
}
