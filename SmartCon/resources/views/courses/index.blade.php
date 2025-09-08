@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Courses</h3>
    <a class="btn btn-primary" href="{{ route('courses.create') }}">Add Course</a>
  </div>
  <table class="table">
    <thead><tr><th>Code</th><th>Title</th><th>Faculty</th><th></th></tr></thead>
    <tbody>
      @foreach($courses as $c)
      <tr>
        <td>{{ $c->code }}</td>
        <td>{{ $c->title }}</td>
        <td>{{ $c->faculty->name ?? 'N/A' }}</td>
        <td class="text-end">
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('courses.edit',$c) }}">Edit</a>
          <form class="d-inline" method="POST" action="{{ route('courses.destroy',$c) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $courses->links() }}
</div>
@endsection
