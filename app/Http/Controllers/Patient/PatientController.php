<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        return view('patient.dashboard');
    }

    public function preform()
    {

        $symptoms = [
            "Fatigue", "Headache", "Congestion", "Cough", "Sneezing", "Mild Fever",
            "Runny Nose", "Sore Throat", "Chills", "Muscle Aches", "High Fever",
            "Shortness of Breath", "Loss of Taste", "Dry Cough", "Nausea", "Red Tonsils",
            "Painful Swallowing", "Swollen Lymph Nodes", "Chest Pain", "Sweating",
            "Abdominal Pain", "Diarrhea", "Vomiting", "Sensitivity to Light", "Dizziness",
            "Sensitivity to Sound", "Blurred Vision", "Itchy Rash", "Loss of Appetite",
            "Sweats", "Persistent Cough", "Weight Loss", "Night Sweats", "Skin Rash",
            "Pain Behind Eyes", "Joint Pain", "Stomach Pain", "Weakness", "Mucus Production",
            "Chest Discomfort", "Nasal Congestion", "Facial Pain"
        ];
        return view('patient.preform',compact('symptoms'));
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
        //
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
