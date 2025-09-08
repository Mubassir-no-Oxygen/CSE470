<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index(Request $request) {
        $items = Availability::where('faculty_id', $request->user()->id)->orderBy('start','asc')->paginate(15);
        return view('availabilities.index', compact('items'));
    }

    public function create() {
        return view('availabilities.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'start'=>'required|date',
            'end'=>'required|date|after:start',
            'location'=>'nullable|string|max:255',
            'notes'=>'nullable|string|max:500',
        ]);
        $data['faculty_id'] = $request->user()->id;
        Availability::create($data);
        return redirect()->route('availabilities.index')->with('ok','Availability added');
    }

    public function edit(Availability $availability) {
        $this->authorize('faculty-only');
        return view('availabilities.edit', ['availability'=>$availability]);
    }

    public function update(Request $request, Availability $availability) {
        $data = $request->validate([
            'start'=>'required|date',
            'end'=>'required|date|after:start',
            'location'=>'nullable|string|max:255',
            'notes'=>'nullable|string|max:500',
        ]);
        $availability->update($data);
        return redirect()->route('availabilities.index')->with('ok','Updated');
    }

    public function destroy(Availability $availability) {
        $availability->delete();
        return redirect()->route('availabilities.index')->with('ok','Deleted');
    }
}
