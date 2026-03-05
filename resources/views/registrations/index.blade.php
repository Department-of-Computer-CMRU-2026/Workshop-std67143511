@extends('layout.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold text-primary mb-0"><i class="bi bi-person-badge"></i> My Workshops</h2>
        <p class="text-muted mt-1">Workshops you have successfully registered for.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('welcome') }}" class="btn btn-outline-primary rounded-pill">
            <i class="bi bi-search"></i> Find More Workshops
        </a>
    </div>
</div>

<div class="row">
    @forelse ($registrations as $registration)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 topic-card border-0">
                <div class="card-header card-header-custom py-3 text-primary">
                    <h5 class="card-title fw-bold mb-0 text-truncate" title="{{ $registration->topic->title }}">
                        {{ $registration->topic->title }}
                    </h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1"><i class="bi bi-calendar-event"></i> Date & Time</small>
                        <span class="fw-medium">{{ $registration->topic->event_date->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1"><i class="bi bi-person-video3"></i> Speaker</small>
                        <span class="fw-medium">{{ $registration->topic->speaker_name }}</span>
                    </div>
                    
                    <div class="mt-auto pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success rounded-pill px-3 py-2"><i class="bi bi-check-circle"></i> Registered</span>
                            <small class="text-muted">Registered on: {{ $registration->created_at->format('d M') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 py-5 text-center">
            <div class="bg-white rounded-4 shadow-sm p-5 border-0">
                <h3 class="fw-bold text-muted mb-3">You haven't registered for any workshops yet!</h3>
                <p class="text-secondary mb-4">Browse our available workshops to secure your seat.</p>
                <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">View Workshops</a>
            </div>
        </div>
    @endforelse
</div>
@endsection
