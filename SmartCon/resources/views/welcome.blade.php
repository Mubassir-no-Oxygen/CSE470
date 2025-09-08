@extends('layouts.app')
@section('content')
<div class="p-5 bg-white rounded shadow-sm">
  <h1 class="mb-3">Smart Consultation Scheduler</h1>
  <p class="text-muted">Book office hours, share files, chat, and leave feedback.</p>
  @guest
    <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
  @else
    <a class="btn btn-primary" href="{{ route('dashboard') }}">Go to Dashboard</a>
  @endguest
</div>
@endsection
