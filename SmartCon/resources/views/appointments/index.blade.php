@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded shadow-sm mb-3">
  <h3>Book a New Appointment</h3>
  <form class="row g-3" method="GET" action="#">
    <div class="col-md-4">
      <label class="form-label">Choose Faculty</label>
      <select class="form-select" onchange="if(this.value) window.location='/appointments/create/'+this.value">
        <option value="">-- Select --</option>
        @foreach($faculties as $f)<option value="{{ $f->id }}">{{ $f->name }}</option>@endforeach
      </select>
    </div>
  </form>
</div>

<div class="bg-white p-4 rounded shadow-sm">
  <h3>Your Appointments</h3>
  <table class="table">
    <thead><tr><th>Start</th><th>End</th><th>With</th><th>Status</th><th></th></tr></thead>
    <tbody>
      @foreach($appointments as $a)
      <tr>
        <td>{{ $a->start }}</td><td>{{ $a->end }}</td>
        <td>{{ $a->faculty->name ?? ('Faculty #'.$a->faculty_id) }}</td>
        <td>{{ $a->status }}</td>
        <td class="text-end">
          @can('reschedule',$a)
          <form class="d-inline" method="POST" action="{{ route('appointments.reschedule',$a) }}">@csrf @method('PATCH')
            <input type="datetime-local" name="start" required> <input type="datetime-local" name="end" required>
            <button class="btn btn-sm btn-outline-secondary">Reschedule</button>
          </form>
          @endcan
          @can('cancel',$a)
          <form class="d-inline" method="POST" action="{{ route('appointments.cancel',$a) }}">@csrf @method('PATCH')<button class="btn btn-sm btn-outline-danger">Cancel</button></form>
          @endcan
          <a class="btn btn-sm btn-outline-primary" href="#" onclick="document.getElementById('chat-{{ $a->id }}').classList.toggle('d-none'); loadMessages({{ $a->id }}, 'chatbox-{{ $a->id }}'); return false;">Open Chat</a>
        </td>
      </tr>
      <tr id="chat-{{ $a->id }}" class="d-none"><td colspan="5">
        <div class="row g-2">
          <div class="col-md-6">
            <div id="chatbox-{{ $a->id }}" class="chat-box"></div>
            <script>setInterval(()=>loadMessages({{ $a->id }}, 'chatbox-{{ $a->id }}'), 5000);</script>
            <form class="mt-2" method="POST" action="{{ route('messages.store',$a) }}">@csrf
              <div class="input-group">
                <input name="content" class="form-control" placeholder="Type message..." required>
                <button class="btn btn-primary">Send</button>
              </div>
            </form>
          </div>
          <div class="col-md-3">
            <h6>Files</h6>
            <form method="POST" action="{{ route('files.store',$a) }}" enctype="multipart/form-data">@csrf
              <input type="file" name="file" class="form-control mb-2" required>
              <button class="btn btn-outline-secondary btn-sm">Upload</button>
            </form>
            <ul class="mt-2">
              @foreach($a->files as $f)
                <li><a href="{{ route('files.download',$f) }}">{{ $f->original_name }}</a></li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-3">
            <h6>Feedback</h6>
            <form method="POST" action="{{ route('feedback.store',$a) }}">@csrf
              <label class="form-label">Rating</label>
              <select name="rating" class="form-select">
                @for($i=1;$i<=5;$i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
              </select>
              <label class="form-label mt-2">Comment</label>
              <textarea name="comment" class="form-control" rows="3"></textarea>
              <button class="btn btn-outline-success btn-sm mt-2">Submit</button>
            </form>
          </div>
        </div>
      </td></tr>
      @endforeach
    </tbody>
  </table>
  {{ $appointments->links() }}
</div>
@endsection
