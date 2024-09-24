<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::where('user_type', 'Doctor')
            ->whereHas('doctor', function ($query) {
                $query->where('is_approved', false);
            })
            ->with('doctor')
            ->get();
        return view('admin.managedoctor', compact('doctors'));
    }

    public function workflow(){
        $totalUsers = User::count();
        $activeDoctors = Doctor::where('is_approved', 1)->count();
        $pendingApprovals = Doctor::where('is_approved', 0)->count();
//        $recentActivities = ActivityLog::latest()->limit(10)->get(); // Example for recent activities

        // Monthly user registrations (combining patients and doctors)
        $monthlyUserRegistrations = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Monthly user predictions
        $monthlyUserPredictions = DB::table('patient_reports')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.workflow', compact('totalUsers', 'activeDoctors', 'pendingApprovals', 'monthlyUserRegistrations', 'monthlyUserPredictions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('doctor')->find($id);

        if (!$user) {
            dd('Doctor not found');
        }



        return view('admin.approveindex', compact('user'));
    }
    public function approve($id)
    {
        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id);

        // Update the is_approved column to 1
        $doctor->is_approved = 1;
        $doctor->save();

        // Redirect back with a success message
       // return redirect()->back()->with('success', 'Doctor approved successfully.');
        return redirect()->route('admin.managedoctor')->with('success', 'Doctor approved successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function listdoctor()
    {
        $doctors = User::where('user_type', 'Doctor')
            ->whereHas('doctor', function ($query) {
                $query->where('is_approved', 1);
            })
            ->with('doctor') // Eager load the related doctor data
            ->get();

        return view('admin.listdoctor', compact('doctors'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user->delete()){
            request()->session()->flash('success', 'Doctor deleted successfully.');
        }else{
            request()->session()->flash('error', 'Doctor deletion failed.');
        }

        return redirect()->back();
    }
}
