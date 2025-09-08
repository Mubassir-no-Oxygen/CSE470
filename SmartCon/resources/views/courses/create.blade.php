@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Add Course</h3>
  <form method="POST" action="{{ route('courses.store') }}">@csrf
    <div class="mb-3"><label class="form-label">Code</label><input name="code" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Title</label><input name="title" class="form-control" required></div>
    <div class="mb-3">
      <label class="form-label">Faculty</label>
      <select name="faculty_id" class="form-select">
        @foreach($faculties as $f) <option value="{{ $f->id }}">{{ $f->name }}</option> @endforeach
      </select>
    </div>
    <button class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
