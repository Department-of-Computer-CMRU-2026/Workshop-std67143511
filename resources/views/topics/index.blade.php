@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Manage Workshop Topics</h2>
    <a href="{{ route('topics.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">+ Add New Topic</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
            <h6 class="text-muted text-uppercase fw-bold small mb-2">Total Topics</h6>
            <h3 class="fw-bold text-primary mb-0">{{ $topics->count() }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        @php
            $totalSeats = $topics->sum('seat_limit');
            $totalRegs = $topics->sum('registrations_count');
            $remaining = max(0, $totalSeats - $totalRegs);
        @endphp
        <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
            <h6 class="text-muted text-uppercase fw-bold small mb-2">Total Capacity</h6>
            <h3 class="fw-bold text-dark mb-0">{{ $totalRegs }} <small class="text-muted fw-normal">/ {{ $totalSeats }}</small></h3>
            <small class="text-success fw-medium mt-1">{{ $remaining }} seats left</small>
        </div>
    </div>
    <div class="col-md-3">
        @php
            $fullCount = $topics->filter(fn($t) => $t->registrations_count >= $t->seat_limit)->count();
        @endphp
        <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
            <h6 class="text-muted text-uppercase fw-bold small mb-2">Full Topics</h6>
            <h3 class="fw-bold text-danger mb-0">{{ $fullCount }}</h3>
            <small class="text-muted mt-1">out of {{ $topics->count() }} total</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center p-3 h-100">
            <h6 class="text-muted text-uppercase fw-bold small mb-2">Total Attendees</h6>
            <h3 class="fw-bold text-info mb-0">{{ $totalRegs }}</h3>
            <small class="text-muted mt-1">across all workshops</small>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Speaker</th>
                        <th>Location</th>
                        <th>Date & Time</th>
                        <th>Seats (Registrations)</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topics as $topic)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $topic->title }}</td>
                        <td><span class="badge bg-secondary rounded-pill">{{ $topic->speaker_name }}</span></td>
                        <td><small class="text-muted">{{ $topic->location ?? 'N/A' }}</small></td>
                        <td><small class="text-muted">{{ $topic->event_date->format('d M Y, H:i') }}</small></td>
                        <td>
                            @php
                                $percent = $topic->seat_limit > 0 ? ($topic->registrations_count / $topic->seat_limit) * 100 : 0;
                                $color = $percent >= 100 ? 'danger' : ($percent >= 80 ? 'warning' : 'success');
                            @endphp
                            <div class="d-flex align-items-center">
                                <span class="me-2 fw-bold text-{{ $color }}">{{ $topic->registrations_count }} / {{ $topic->seat_limit }}</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('topics.attendees', $topic) }}" class="btn btn-sm btn-info text-white rounded-pill px-3">Attendees</a>
                            <a href="{{ route('topics.edit', $topic) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                            <form action="{{ route('topics.destroy', $topic) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this topic?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <h5 class="mb-3">No topics available</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
