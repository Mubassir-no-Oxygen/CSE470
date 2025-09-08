@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Your Upcoming Appointments</h3>
  <ul class="list-group">
    @foreach($appointments as $a)
      <li class="list-group-item">{{ $a->start }} - {{ $a->end }} with {{ $a->faculty->name ?? ('Faculty #'.$a->faculty_id) }} ({{ $a->status }})</li>
    @endforeach
  </ul>
</div>
@endsection
