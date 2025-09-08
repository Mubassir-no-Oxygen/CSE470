@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Book with {{ $faculty->name }}</h3>
  <form method="POST" action="{{ route('appointments.store') }}">@csrf
    <input type="hidden" name="faculty_id" value="{{ $faculty->id }}">
    <div class="mb-3">
      <label class="form-label">Choose Slot</label>
      <select name="start" class="form-select" required onchange="document.getElementById('end').value=this.selectedOptions[0].dataset.end">
        <option value="">-- Select --</option>
        @foreach($slots as $s)
          <option value="{{ $s->start }}" data-end="{{ $s->end }}">{{ $s->start }} - {{ $s->end }} @if($s->location) ({{ $s->location }}) @endif</option>
        @endforeach
      </select>
    </div>
    <input type="hidden" id="end" name="end" required>
    <div class="mb-3"><label class="form-label">Notes (optional)</label><textarea name="notes" class="form-control"></textarea></div>
    <button class="btn btn-primary">Request Appointment</button>
  </form>
  <p class="text-muted mt-3">If the selected time is taken, you'll be automatically added to a waitlist.</p>
</div>
@endsection
