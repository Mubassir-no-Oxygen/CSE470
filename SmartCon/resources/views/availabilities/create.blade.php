@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Add Availability Slot</h3>
  <form method="POST" action="{{ route('availabilities.store') }}">@csrf
    <div class="mb-3"><label class="form-label">Start</label><input type="datetime-local" name="start" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">End</label><input type="datetime-local" name="end" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Location</label><input name="location" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Notes</label><input name="notes" class="form-control"></div>
    <button class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
