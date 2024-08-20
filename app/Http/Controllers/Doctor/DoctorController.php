<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $userName = $user->first_name;
        $isApproved  = $user->doctor->is_approved;
        return view('doctor.dashboard', compact('userName','isApproved'));
    }

    public function profile()
    {
        $userId = auth()->id();
        $user = User::find($userId);
//        $userName = $user->first_name;
        $isApproved  = $user->doctor->is_approved;
        return view('doctor.profile', compact('user','isApproved'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user(); // Assuming the user is authenticated
        return view('doctor.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
