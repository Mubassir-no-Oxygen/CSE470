@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Edit Slot</h3>
  <form method="POST" action="{{ route('availabilities.update',$availability) }}">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Start</label><input type="datetime-local" name="start" class="form-control" value="{{ \Carbon\Carbon::parse($availability->start)->format('Y-m-d\TH:i') }}" required></div>
    <div class="mb-3"><label class="form-label">End</label><input type="datetime-local" name="end" class="form-control" value="{{ \Carbon\Carbon::parse($availability->end)->format('Y-m-d\TH:i') }}" required></div>
    <div class="mb-3"><label class="form-label">Location</label><input name="location" class="form-control" value="{{ $availability->location }}"></div>
    <div class="mb-3"><label class="form-label">Notes</label><input name="notes" class="form-control" value="{{ $availability->notes }}"></div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
