@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Analytics</h3>
  <p>Ratings breakdown:</p>
  <ul>
    @foreach($ratings as $rating => $count)
      <li>{{ $rating }} stars: {{ $count }}</li>
    @endforeach
  </ul>
  <p class="mt-3">Appointments per day:</p>
  <ul>
    @foreach($appointments as $row)
      <li>{{ $row->d }}: {{ $row->c }}</li>
    @endforeach
  </ul>
</div>
@endsection
