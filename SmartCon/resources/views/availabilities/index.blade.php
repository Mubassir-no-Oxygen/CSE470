@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Your Availabilities</h3>
    <a class="btn btn-primary" href="{{ route('availabilities.create') }}">Add Slot</a>
  </div>
  <table class="table">
    <thead><tr><th>Start</th><th>End</th><th>Location</th><th>Notes</th><th></th></tr></thead>
    <tbody>
    @foreach($items as $a)
      <tr>
        <td>{{ $a->start }}</td><td>{{ $a->end }}</td><td>{{ $a->location }}</td><td>{{ $a->notes }}</td>
        <td class="text-end">
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('availabilities.edit',$a) }}">Edit</a>
          <form class="d-inline" method="POST" action="{{ route('availabilities.destroy',$a) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $items->links() }}
</div>
@endsection
