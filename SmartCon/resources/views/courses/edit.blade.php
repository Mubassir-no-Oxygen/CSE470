@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
  <h3>Edit Course</h3>
  <form method="POST" action="{{ route('courses.update',$course) }}">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Code</label><input name="code" class="form-control" value="{{ $course->code }}" required></div>
    <div class="mb-3"><label class="form-label">Title</label><input name="title" class="form-control" value="{{ $course->title }}" required></div>
    <div class="mb-3">
      <label class="form-label">Faculty</label>
      <select name="faculty_id" class="form-select">
        @foreach($faculties as $f) <option value="{{ $f->id }}" @if($course->faculty_id==$f->id) selected @endif>{{ $f->name }}</option> @endforeach
      </select>
    </div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
