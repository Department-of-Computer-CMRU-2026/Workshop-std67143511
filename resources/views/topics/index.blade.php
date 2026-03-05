@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Manage Workshop Topics</h2>
    <a href="{{ route('topics.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">+ Add New Topic</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Speaker</th>
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
