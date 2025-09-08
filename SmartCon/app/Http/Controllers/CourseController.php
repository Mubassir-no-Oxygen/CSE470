<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::with('faculty')->paginate(15);
        return view('courses.index', compact('courses'));
    }

    public function create() {
        $faculties = User::where('role','faculty')->get();
        return view('courses.create', compact('faculties'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'code'=>'required|string|max:20',
            'title'=>'required|string|max:255',
            'faculty_id'=>'required|exists:users,id'
        ]);
        Course::create($data);
        return redirect()->route('courses.index')->with('ok','Course created');
    }

    public function edit(Course $course) {
        $faculties = User::where('role','faculty')->get();
        return view('courses.edit', compact('course','faculties'));
    }

    public function update(Request $request, Course $course) {
        $data = $request->validate([
            'code'=>'required|string|max:20',
            'title'=>'required|string|max:255',
            'faculty_id'=>'required|exists:users,id'
        ]);
        $course->update($data);
        return redirect()->route('courses.index')->with('ok','Course updated');
    }

    public function destroy(Course $course) {
        $course->delete();
        return redirect()->route('courses.index')->with('ok','Course deleted');
    }
}
