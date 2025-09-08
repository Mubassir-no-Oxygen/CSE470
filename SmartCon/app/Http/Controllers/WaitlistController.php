<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use Illuminate\Http\Request;

class WaitlistController extends Controller
{
    public function index()
    {
        // Show all waitlist entries for the logged-in faculty
        $waitlists = Waitlist::where('faculty_id', auth()->id())->with('student')->get();
        return view('waitlists.index', compact('waitlists'));
    }

    public function accept($id)
    {
        $waitlist = Waitlist::findOrFail($id);

        // Optionally, create an appointment here

        $waitlist->delete(); // Remove from waitlist

        return redirect()->route('waitlists.index')->with('ok', 'Student accepted!');
    }
}