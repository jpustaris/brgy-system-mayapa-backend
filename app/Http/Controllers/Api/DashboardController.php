<?php

namespace App\Http\Controllers\Api;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function fetchDashboardData()
    {
        $seniors = $this->fetchTotalSeniors();
        $residents = $this->fetchTotalResidents();
        $healthworkers = $this->fetchTotalHealthWorkers();
        $pwds = $this->fetchTotalPWDs();

        return response()->json([
            'status' => 'success', 
            'seniors' => $seniors, 
            'residents' => $residents, 
            'healthworkers' => $healthworkers, 
            'pwds' => $pwds,
        ], 200);
    
    }

    private function fetchTotalResidents()
    {
        $data = Resident::where('is_deceased',0)->count();
        return $data;
    }

    private function fetchTotalSeniors()
    {
        $data = Resident::where("age",'>=' ,60)
        ->where('is_deceased',0)
        ->count();
        return $data;
    }

    private function fetchTotalHealthWorkers()
    {
        $data = Resident::where("is_HW",1)
        ->where('is_deceased',0)
        ->count();
        return $data;
    }

    private function fetchTotalPWDs()
    {
        $data = Resident::where("is_PWD" ,1)
        ->where('is_deceased',0)
        ->count();
        return $data;
    }
    
}