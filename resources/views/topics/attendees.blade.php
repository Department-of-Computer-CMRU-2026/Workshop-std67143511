@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Attendee List</h2>
        <p class="text-muted"><i class="bi bi-bookmark-fill text-primary"></i> {{ $topic->title }}</p>
    </div>
    <a href="{{ route('topics.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left"></i> Back to Topics
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center p-3">
            <h6 class="text-muted text-uppercase fw-bold small mb-1">Total Registrations</h6>
            <h3 class="fw-bold text-primary mb-0">{{ $attendees->count() }} / {{ $topic->seat_limit }}</h3>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Student Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Student ID</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendees as $attendee)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $attendee->name }}</div>
                        </td>
                        <td>{{ $attendee->email }}</td>
                        <td>{{ $attendee->phone }}</td>
                        <td><span class="badge bg-light text-dark">{{ $attendee->student_id ?? 'N/A' }}</span></td>
                        <td class="text-end pe-4">
                            <form action="{{ route('registrations.destroy', $attendee) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this attendee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <div class="mb-3"><i class="bi bi-people fs-1 opacity-25"></i></div>
                            <h5>No attendees registered yet</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
