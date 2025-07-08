<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class FrontendController extends Controller
{
    public function home() {
        return view('frontend.home');
    }

    public function about() {
        return view('frontend.about');
    }

    public function services() {
        return view('frontend.services');
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function appointment() {
        return view('frontend.appointment');
    }   
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'doctor_name' => 'required|string|max:255',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        Appointment::create($validated);

        return redirect()->back()->with('success', 'Your appointment has been submitted successfully!');
    }

}
