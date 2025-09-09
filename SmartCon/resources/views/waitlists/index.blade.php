<!DOCTYPE html>
<head>
    <title>Waitlist Management</title>
    <link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">
 </head>   
<body>
<h2>Waitlist Management</h2>
@if($waitlists->isEmpty())
    <p>No students are currently on the waitlist.</p>
@endif
@foreach($waitlists as $waitlist)
  <tr>
    <td>{{ $waitlist->student->name }}</td>
    <td>
      <form method="POST" action="{{ route('waitlists.accept', $waitlist->id) }}">
        @csrf
        <button class="btn btn-success btn-sm">Accept</button>
        <button class="btn btn-danger btn-sm">Reject</button>
      </form>
      <form method="POST" action="{{ route('waitlists.reject', $waitlist->id) }}">
        @csrf
        <button class="btn btn-danger btn-sm">Reject</button>
      </form>

    </td>
  </tr>
@endforeach
</html>