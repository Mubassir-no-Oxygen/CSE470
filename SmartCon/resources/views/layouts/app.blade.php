<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart Consultation Scheduler</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style> .chat-box{height:300px;overflow:auto;border:1px solid #ccc;padding:10px;border-radius:8px;} </style>
</head>
@yield('Muba')
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Scheduler</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
          @if(auth()->user()->isStudent())
          <li class="nav-item"><a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.waitlists') }}">Waitlist</a></li>
          @endif
          @if(auth()->user()->isFaculty())
          <li class="nav-item"><a class="nav-link" href="{{ route('waitlists.index') }}">Waitlists</a></li>
          @endif
          @can('manage-courses')
          <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">Courses</a></li>
          @endcan
          @can('faculty-only')
          <li class="nav-item"><a class="nav-link" href="{{ route('availabilities.index') }}">Availabilities</a></li>
          @endcan
          @can('admin-only')
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.analytics') }}">Analytics</a></li>
          @endcan
        @endauth
      </ul>
      <ul class="navbar-nav">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
          <li class="nav-item"><span class="navbar-text me-2">{{ auth()->user()->name }}</span></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-sm btn-outline-light">Logout</button></form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<div class="container mb-5">
  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
  @if(session('error')) <div class="alert alert-warning">{{ session('error') }}</div> @endif
  {{ $slot ?? '' }}
  @yield('content')
</div>

<script>
// basic long-poll for chat
async function loadMessages(appointmentId, elId) {
  try{
    const res = await fetch(`/messages/${appointmentId}`);
    const data = await res.json();
    const el = document.getElementById(elId);
    if(!el) return;
    el.innerHTML = data.map(m => `<div><strong>${m.sender_id}</strong>: ${m.content} <small class="text-muted">(${m.created_at})</small></div>`).join('');
    el.scrollTop = el.scrollHeight;
  }catch(e){}
}
</script>
</body>
</html>
