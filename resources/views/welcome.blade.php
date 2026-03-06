@extends('layout.app')

@section('content')
<!-- Immersive Hero Section -->
<div class="row mb-5 position-relative">
    <div class="col-12">
        <div class="hero-premium rounded-5 overflow-hidden position-relative p-4 p-md-5 d-flex align-items-center justify-content-center">
            <!-- Animated Background Glows -->
            <div class="glow-orb orb-1"></div>
            <div class="glow-orb orb-2"></div>
            <div class="glow-orb orb-3"></div>

            <!-- Dark overlay for better text contrast -->
            <div class="hero-overlay"></div>

            <div class="hero-content position-relative z-index-2 text-center py-5">
                <div class="d-inline-flex align-items-center badge-premium mb-4">
                    <span class="badge bg-gradient-primary rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                        <i class="bi bi-lightning-charge-fill text-white" style="font-size: 0.7rem;"></i>
                    </span>
                    <span class="text-white-50 fw-semibold text-uppercase tracking-wider fs-7">Exclusive Masterclasses</span>
                </div>
                
                <h1 class="hero-title fw-black mb-4 text-white">
                    Senior-to-Junior <br class="d-none d-md-block"/> 
                    <span class="text-gradient-gold">Workshop 2026</span>
                </h1>
                
                <p class="hero-subtitle fw-normal text-white-50 mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; line-height: 1.6;">
                    Accelerate your growth by learning directly from experienced seniors. Master the skills you need for real-world development.
                </p>
                
                <div class="mt-5 d-flex justify-content-center gap-3">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Title -->
<div class="d-flex justify-content-between align-items-end mb-4 px-2">
    <div>
        <h2 class="fw-black text-dark mb-1">Available <span class="text-primary text-gradient">Sessions</span></h2>
        <p class="text-secondary mb-0">Secure your spot before they fill up</p>
    </div>
</div>

<!-- Workshop Cards -->
<div class="row g-4 mb-5">
    @forelse($topics as $topic)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-premium rounded-5 overflow-hidden card-hover transition-300 bg-white d-flex flex-column">
                <!-- Card Header - Date & Status -->
                <div class="p-4 pb-0 d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold shadow-sm-subtle">
                        <i class="bi bi-calendar3 me-1"></i> {{ $topic->event_date->format('d M Y') }}
                    </span>
                    
                    @php
                        $availableSeats = $topic->seat_limit - $topic->registrations_count;
                        $isFull = $availableSeats <= 0;
                        $isRegistered = Auth::check() && Auth::user()->registrations->contains('topic_id', $topic->id);
                    @endphp

                    @if($isRegistered)
                        <span class="badge bg-success bg-gradient text-white rounded-pill px-3 py-2 fw-bold shadow-sm">
                            <i class="bi bi-check-circle-fill me-1"></i> Enrolled
                        </span>
                    @elseif($isFull)
                        <span class="badge bg-danger bg-gradient text-white rounded-pill px-3 py-2 fw-bold shadow-sm">
                            <i class="bi bi-x-circle-fill me-1"></i> Full
                        </span>
                    @else
                        <span class="badge bg-light text-dark rounded-pill px-3 py-2 fw-bold border">
                            <i class="bi bi-people-fill text-muted me-1"></i> {{ max(0, $availableSeats) }} Left
                        </span>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="card-body p-4 flex-grow-1 d-flex flex-column">
                    <h3 class="card-title fw-black text-dark mb-3 line-clamp-2" style="font-size: 1.4rem; line-height: 1.3;">
                        {{ $topic->title }}
                    </h3>
                    
                    <!-- Meta Info Grid -->
                    <div class="row g-2 mb-4">
                        <div class="col-12">
                            <div class="d-flex align-items-center p-2 rounded-3 bg-light border border-white">
                                <i class="bi bi-person-circle fs-5 text-primary me-2"></i>
                                <div>
                                    <div class="text-muted small lh-1" style="font-size: 0.7rem;">SPEAKER</div>
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.9rem;">{{ $topic->speaker_name }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center p-2 rounded-3 bg-light border border-white h-100">
                                <i class="bi bi-clock-history fs-5 text-warning me-2"></i>
                                <div>
                                    <div class="text-muted small lh-1" style="font-size: 0.7rem;">TIME</div>
                                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $topic->event_date->format('H:i') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center p-2 rounded-3 bg-light border border-white h-100">
                                <i class="bi bi-geo-alt-fill fs-5 text-danger me-2"></i>
                                <div class="w-100 overflow-hidden">
                                    <div class="text-muted small lh-1" style="font-size: 0.7rem;">VENUE</div>
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.9rem;">{{ $topic->location ?? 'TBA' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="card-text text-secondary line-clamp-2 small mt-auto mb-0" style="font-size: 0.85rem;">
                        {{ $topic->description }}
                    </p>
                </div>

                <!-- Card Footer / Actions -->
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ $isRegistered ? route('registrations.index') : route('topics.show', $topic) }}" class="btn btn-outline-primary rounded-pill fw-bold flex-grow-1 shadow-sm">
                            Details
                        </a>
                        
                        @if(!Auth::check() || !Auth::user()->is_admin)
                            @if($isRegistered)
                                <button class="btn btn-success   rounded-pill fw-bold shadow-sm px-4" disabled>
                                    <i class="bi bi-check2"></i>
                                </button>
                            @elseif($isFull)
                                <button class="btn btn-secondary rounded-pill fw-bold shadow-sm px-4" disabled>
                                    Full
                                </button>
                            @else
                                <a href="{{ route('registrations.create', $topic) }}" class="btn btn-primary rounded-pill fw-bold shadow-primary-subtle px-4">
                                    Join
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="bg-white rounded-5 shadow-sm p-5 border-0 text-center mx-auto" style="max-width: 600px;">
                <div class="mb-4">
                    <div class="bg-light rounded-circle p-4 d-inline-flex justify-content-center align-items-center">
                        <i class="bi bi-calendar-x fs-1 text-muted opacity-50"></i>
                    </div>
                </div>
                <h3 class="fw-black text-dark mb-2">No Workshops Available</h3>
                <p class="text-muted mb-0">Our speakers are currently preparing new exciting sessions. Please check back later!</p>
            </div>
        </div>
    @endforelse
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap');

h1, h2, h3, h4, h5, .fw-black { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; letter-spacing: -0.02em; }
.hero-premium { margin-top: -2rem; min-height: 480px; background: #060b19; box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important; border: 1px solid rgba(255,255,255,0.05); }
.hero-overlay { position: absolute; inset: 0; background: radial-gradient(circle at center, transparent 0%, rgba(6, 11, 25, 0.8) 100%); z-index: 1; }
.glow-orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.6; animation: float 10s infinite ease-in-out; }
.orb-1 { width: 300px; height: 300px; background: #0d6efd; top: -50px; left: -50px; animation-delay: 0s; }
.orb-2 { width: 250px; height: 250px; background: #6610f2; bottom: -50px; right: 10%; animation-delay: -3s; }
.orb-3 { width: 200px; height: 200px; background: #0dcaf0; top: 20%; left: 50%; transform: translateX(-50%); animation-delay: -6s; opacity: 0.4; }
@keyframes float { 0%, 100% { transform: translate(0, 0) scale(1); } 33% { transform: translate(20px, -30px) scale(1.1); } 66% { transform: translate(-20px, 20px) scale(0.9); } }
.hero-title { font-size: clamp(2.5rem, 5vw, 4.2rem); line-height: 1.1; letter-spacing: -0.03em; text-shadow: 0 10px 30px rgba(0,0,0,0.5); }
.text-gradient-gold { background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block; }
.bg-gradient-primary { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
.badge-premium { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 50px; padding: 0.35rem 1rem 0.35rem 0.35rem; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
.btn-premium { background: white; color: #0d6efd; border: none; transition: all 0.3s ease; }
.btn-premium:hover { background: #f8f9fa; color: #0a58ca; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(13, 110, 253, 0.3) !important; }
.btn-premium:hover .bi-arrow-right { transform: translateX(5px); }
.fs-7 { font-size: 0.85rem; }
.tracking-wider { letter-spacing: 0.08em; }
.transition-transform { transition: transform 0.3s ease; }
.z-index-2 { z-index: 2; }

.text-gradient { background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.shadow-premium { box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
.shadow-primary-subtle { box-shadow: 0 4px 15px rgba(13, 110, 253, 0.25); }
.shadow-sm-subtle { box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
.text-shadow-sm { text-shadow: 0 2px 10px rgba(0,0,0,0.2); }
.card-hover:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important; }
.transition-300 { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.tracking-wide { letter-spacing: 0.05em; }
</style>
@endsection
