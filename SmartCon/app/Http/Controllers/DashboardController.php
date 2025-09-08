<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->isAdmin()) {
            $appointmentsCount = Appointment::count();
            $avgRating = Feedback::avg('rating');
            return view('dashboard.admin', compact('appointmentsCount','avgRating'));
        } elseif ($user->isFaculty()) {
            $appointments = Appointment::where('faculty_id', $user->id)->orderBy('start','asc')->limit(20)->get();
            return view('dashboard.faculty', compact('appointments'));
        } else {
            $appointments = Appointment::where('student_id', $user->id)->orderBy('start','asc')->limit(20)->get();
            return view('dashboard.student', compact('appointments'));
        }
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function analytics()
    {
        $ratings = Feedback::selectRaw('rating, count(*) as c')->groupBy('rating')->pluck('c','rating');
        $appointments = Appointment::selectRaw('date(start) d, count(*) c')->groupBy('d')->orderBy('d','asc')->get();
        return view('admin.analytics', compact('ratings','appointments'));
    }
}
