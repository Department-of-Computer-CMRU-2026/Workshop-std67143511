@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $topic->title }}</li>
                </ol>
            </nav>

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden mt-2">
                <div class="bg-primary bg-gradient p-5 text-white text-center">
                    <span class="badge bg-white text-primary rounded-pill mb-3 px-3 py-2 fw-medium shadow-sm">
                        <i class="bi bi-calendar-event me-1"></i> {{ $topic->event_date->format('j M Y, H:i') }}
                    </span>
                    <h1 class="display-5 fw-bold mb-0 text-white">{{ $topic->title }}</h1>
                </div>
                
                <div class="card-body p-5">
                    <div class="row align-items-center mb-5 bg-light rounded-4 p-4 inner-shadow-sm">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <h6 class="text-muted text-uppercase fw-bold letter-spacing-1 mb-2">Speaker</h6>
                            <h4 class="mb-0 text-dark fw-bold"><i class="bi bi-person-fill-check text-primary me-2"></i>{{ $topic->speaker_name }}</h4>
                        </div>
                        <div class="col-md-6 text-center text-md-end border-md-start">
                            @php
                                $availableSeats = $topic->seat_limit - $topic->registrations_count;
                                $isFull = $availableSeats <= 0;
                                $isRegistered = Auth::check() && Auth::user()->registrations->contains('topic_id', $topic->id);
                            @endphp
                            <h6 class="text-muted text-uppercase fw-bold letter-spacing-1 mb-2">Availability</h6>
                            <h4 class="mb-0 {{ $isFull ? 'text-danger' : 'text-success' }} fw-bold">
                                <i class="bi bi-people-fill me-2"></i>{{ max(0, $availableSeats) }} Seats Left
                            </h4>
                            <small class="text-muted d-block mt-1">out of {{ $topic->seat_limit }} total</small>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">Workshop Overview</h5>
                    <div class="mb-5 lead text-secondary lh-lg" style="white-space: pre-line;">{{ $topic->description }}</div>

                    <div class="text-center mt-5 pt-3">
                        @if(!Auth::check() || !Auth::user()->is_admin)
                            @if($isRegistered)
                                <button class="btn btn-success btn-lg rounded-pill px-5 py-3 shadow-sm" disabled>
                                    <i class="bi bi-check-circle-fill me-2"></i>You are registered for this workshop!
                                </button>
                            @elseif($isFull)
                                <button class="btn btn-secondary btn-lg rounded-pill px-5 py-3 shadow-sm" disabled>
                                    <i class="bi bi-x-circle me-2"></i>Workshop Full
                                </button>
                            @else
                                <a href="{{ route('registrations.create', $topic) }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow hover-lift transition-all">
                                    <i class="bi bi-ticket-perforated me-2"></i>Register Now
                                </a>
                            @endif
                        @else
                            <div class="alert alert-info rounded-pill">
                                <i class="bi bi-info-circle me-2"></i>Administrators cannot register for workshops.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.letter-spacing-1 { letter-spacing: 1px; }
.hover-lift:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
.transition-all { transition: all 0.3s ease; }
.inner-shadow-sm { box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); }
.border-md-start { border-left: 1px solid #dee2e6; }
@media (max-width: 767.98px) {
    .border-md-start { border-left: none; }
}
</style>
@endsection
