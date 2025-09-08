@extends('layouts.app')
@section('content')
<div class="row g-3">
  <div class="col-md-4">
    <div class="p-4 bg-white rounded shadow-sm">
      <h4>Total Appointments</h4>
      <div class="display-6">{{ $appointmentsCount }}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="p-4 bg-white rounded shadow-sm">
      <h4>Average Rating</h4>
      <div class="display-6">{{ number_format($avgRating,2) }}</div>
    </div>
  </div>
</div>
@endsection
