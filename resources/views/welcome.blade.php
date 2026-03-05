@extends('layout.app')

@section('content')
<div class="text-center hero mb-5">
    <h1 class="display-5 fw-bold mb-3">Senior-to-Junior Workshop 2026</h1>
    <p class="lead mb-0">Learn from the best. Register for specialized sessions below.</p>
</div>

<div class="row g-4">
    @forelse($topics as $topic)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 topic-card border-0">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-2 px-3 py-2">
                        <i class="bi bi-calendar-event me-1"></i> {{ $topic->event_date->format('j M Y, H:i') }}
                    </span>
                    <h4 class="card-title fw-bold text-dark mb-1">{{ $topic->title }}</h4>
                    <p class="text-muted small mb-0">Speaker: <span class="fw-medium text-dark">{{ $topic->speaker_name }}</span></p>
                    <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1"></i>{{ $topic->location ?? 'To be announced' }}</p>
                </div>
                <div class="card-body">
                    <p class="card-text text-secondary line-clamp-3">{{ $topic->description }}</p>
                </div>
                <div class="card-footer bg-white border-0 pt-0 pb-4">
                    @php
                        $availableSeats = $topic->seat_limit - $topic->registrations_count;
                        $isFull = $availableSeats <= 0;
                        $isRegistered = Auth::check() && Auth::user()->registrations->contains('topic_id', $topic->id);
                    @endphp
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small">Available Seats</span>
                        <span class="badge {{ $isFull ? 'bg-danger' : 'bg-success' }} rounded-pill fs-6 px-3">
                            {{ max(0, $availableSeats) }}
                        </span>
                    </div>

                    <div class="d-grid gap-2">
                        @if(!Auth::check() || !Auth::user()->is_admin)
                            @if($isRegistered)
                                <button class="btn btn-success bg-opacity-75 rounded-pill shadow-sm" disabled><i class="bi bi-check2-circle me-1"></i>Registered</button>
                            @elseif($isFull)
                                <button class="btn btn-secondary rounded-pill shadow-sm" disabled>Full</button>
                            @else
                                <a href="{{ route('registrations.create', $topic) }}" class="btn btn-primary rounded-pill shadow-sm">Register Now</a>
                            @endif
                        @endif
                        <a href="{{ route('topics.show', $topic) }}" class="btn btn-outline-primary rounded-pill shadow-sm">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">No workshops available right now.</h3>
            <p>Please check back later.</p>
        </div>
    @endforelse
</div>
@endsection
