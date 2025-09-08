@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>All Users</h3>
  <table class="table">
    <thead><tr><th>Name</th><th>Email</th><th>Role</th></tr></thead>
    <tbody>
      @foreach($users as $u)
      <tr><td>{{ $u->name }}</td><td>{{ $u->email }}</td><td>{{ $u->role }}</td></tr>
      @endforeach
    </tbody>
  </table>
  {{ $users->links() }}
</div>
@endsection
