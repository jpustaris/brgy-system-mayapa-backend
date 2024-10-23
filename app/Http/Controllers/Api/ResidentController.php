<?php

namespace App\Http\Controllers\Api;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;


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
        $image_name = "";
        $validator = Validator::make($request->all(), [
            'profile_pic' => 'required|mimes:jpg,png|max:2048',
            'salutation' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'nationality' => 'required|string',
            'contact_number',
            'email' => 'required|string',
            'age' => 'required|integer',
            'street' => 'required|string',
            'house_number',
            'building',
            'other_location',
            'weight_kg' => 'required|integer',
            'height_ft' => 'required|integer',            
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'birthdate',
            'additional_name',
            'unique_identity',
            'is_voter' => 'required|integer',
            'is_HW' => 'required|integer',
            'is_PWD' => 'required|integer',
            'is_deceased' => 'required|integer',            
            'disability',
            'added_by',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
            $resident = new Resident();
            $resident->salutation = $request->salutation;
            $resident->first_name = $request->first_name;
            $resident->middle_name = $request->middle_name;
            $resident->last_name = $request->last_name;
            $resident->nationality = $request->nationality;
            $resident->contact_number = $request->contact_number;
            $resident->email = $request->email;
            $resident->age = $request->age;
            $resident->street = $request->street;
            $resident->house_number = $request->house_number;
            $resident->building = $request->building;
            $resident->other_location = $request->other_location;
            $resident->weight_kg = $request->weight_kg;
            $resident->height_ft = $request->height_ft;
            $resident->gender = $request->gender;
            $resident->marital_status = $request->marital_status;
            $resident->birthdate = $request->birthdate;
            $resident->additional_name = $request->additional_name;
            $resident->unique_identity = $request->unique_identity;
            $resident->is_voter = $request->is_voter;
            $resident->is_HW = $request->is_HW;
            $resident->is_PWD = $request->is_PWD;
            $resident->is_deceased = $request->is_deceased;
            $resident->disability = $request->disability;
            $resident->added_by = $request->added_by;

            if ($request['profile_pic']) {
                $image = $request['profile_pic'];
                $extension = $image->getClientOriginalName();
                $name = time() . '_' . $image->getClientOriginalName();
                Storage::disk('public')->put($name , File::get($image));
                $resident->profile_pic = $name;
            }else{
                $resident->profile_pic = 'default.jpg';
            }
            $resident->save();

        // $file = $request->file('profile_pic');
        // $path = $file->store('uploads', 'public');



        // if ($temp) {
        //     $image_name = time() . '.' . $file->extension();
        //     $image = Image::make($request->file('profile_pic'))
        //         ->resize(120, 120, function ($constraint) {
        //             $constraint->aspectRatio();
        //          });
    
        //     //here you can define any directory name whatever you want, if dir is not exist it will created automatically.
        //     // Storage::putFileAs('public/images/1/smalls/' . $image_name, (string)$image->encode('png', 95), $image_name);
        //     Storage::disk('public')->put($image, File::get($image));
        // }

        

        // $resident = Resident::create([
        //     'salutation' => $request->salutation,
        //     'first_name' =>  $request->first_name,
        //     'middle_name' =>  $request->middle_name,
        //     'last_name' =>  $request->last_name,
        //     'nationality' => $request->nationality,
        //     'contact_number' => $request->contact_number,
        //     'email' => $request->email,
        //     'age' => $request->age,
        //     'profile_pic' => $image_name,
        //     // 'thumb_pic' => $request->thumb_pic,
        //     'street' => $request->street,
        //     'house_number' => $request->house_number,
        //     'building' => $request->building,
        //     'other_location' => $request->other_location,
        //     'weight_kg' => $request->weight_kg,
        //     'height_ft' => $request->height_ft,            
        //     'gender' => $request->gender,
        //     'marital_status' => $request->marital_status,
        //     'birthdate' => $request->birthdate,
        //     'additional_name' => $request->additional_name,
        //     'unique_identity' => $request->unique_identity,
        //     'is_voter' => $request->is_voter,
        //     'is_HW' => $request->is_HW,
        //     'is_PWD' => $request->is_PWD,
        //     'is_deceased' => $request->is_deceased,            
        //     'disability' => $request->disability,
        //     'added_by' => $request->added_by,
        // ]);

        return response()->json(['status' => 'success', 'data' => $resident], 201);
    }

    public function textBlast(Request $request)
    {
        //
        $api_path = config('config.api_path');
        $api_key = config('config.api_key');
        $message = $request->message;
        $sender = $request->sender;
        $numbers = $request->resident_numbers;
        $data = [
            'api_key' => $api_key,
            'number' => $numbers ,
            'message' => $message ,
            'sendername' => $sender ,
        ];
        Http::post($api_path,$data);
    }

    // private function getNumbers($resident_ids){
    //     $temp = Resident::select("contact_number")->whereIn("id",$resident_ids)->value("contact_number");
    // }

    // public function getNumbers(Request $request){
    //     $temp = $request->resident_ids;
    //     $plucked_ids = Arr::pluck( $temp, 'id');
    //     $data = Resident::select("contact_number")
    //     ->whereIn("id",$plucked_ids)
    //     ->get();

    //     $data_string = "";
    //     foreach ($data as $key => $value) {
    //         if
    //         $data_string + $value;
    //     }
    //     return $data_string;
    // }

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
