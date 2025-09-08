
@extends('layouts.app')
@section('Muba')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Waitlists</h3>
  <table class="table">
    <thead><tr><th>Faculty</th><th>Student</th><th>Course</th><th>Requested At</th></tr></thead>
    <tbody>
      @foreach($waitlists as $w)
      <tr>
        <td>{{ $w->faculty->name }}</td>
        <td>{{ $w->student->name }}</td>
        <td>{{ $w->course_code }}</td>
        <td>{{ $w->created_at }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $waitlists->links() }}
</div>
@endsection