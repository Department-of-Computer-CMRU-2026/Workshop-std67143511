@extends('layout.app')

@section('content')
<div class="row mb-5 align-items-end">
    <div class="col-md-7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        <h1 class="display-5 fw-bold text-dark mb-0">My <span class="text-primary text-gradient">Workshops</span></h1>
        <p class="text-secondary fs-5 mt-2">Manage your learning journey and upcoming sessions.</p>
    </div>
    <div class="col-md-5">
        <div class="row g-2">
            <div class="col-6">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="text-primary fw-bold small text-uppercase mb-1">Enrolled</div>
                    <div class="h3 fw-bold mb-0 text-dark">{{ $registrations->count() }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="text-success fw-bold small text-uppercase mb-1">Upcoming</div>
                    <div class="h3 fw-bold mb-0 text-dark">{{ $registrations->filter(fn($r) => $r->topic->event_date->isFuture())->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    @forelse ($registrations as $registration)
        @php $topic = $registration->topic; @endphp
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-premium rounded-5 overflow-hidden card-hover transition-300 bg-white">
                <div class="position-relative">
                    <div class="bg-primary bg-gradient p-4 text-white d-flex justify-content-between align-items-start" style="height: 120px;">
                        <div>
                            <span class="badge bg-white bg-opacity-25 backdrop-blur rounded-pill px-3 py-2 small fw-bold">
                                <i class="bi bi-patch-check-fill me-1"></i>CONFIRMED
                            </span>
                        </div>
                        <div class="date-badge bg-white rounded-4 shadow-sm text-center p-2" style="width: 55px;">
                            <div class="text-primary fw-bold small text-uppercase lh-1" style="font-size: 0.65rem;">{{ $topic->event_date->format('M') }}</div>
                            <div class="text-dark fw-black h4 mb-0 lh-1">{{ $topic->event_date->format('d') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4 pt-5 position-relative">
                    <!-- Icon placeholder / accent -->
                    <div class="position-absolute translate-middle-y top-0 start-0 ms-4" style="margin-top: -15px;">
                        <div class="bg-white rounded-pill shadow-sm p-2 d-inline-flex">
                            <div class="bg-primary bg-opacity-10 rounded-pill p-3">
                                <i class="bi bi-journal-bookmark-fill text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-title fw-black text-dark mb-4 mt-3 line-clamp-2" style="height: 3.5rem; line-height: 1.2;">
                        {{ $topic->title }}
                    </h4>
                    
                    <div class="space-y-3 mb-4">
                        <div class="d-flex align-items-center p-3 rounded-4 bg-light border border-white">
                            <div class="flex-shrink-0 me-3">
                                <i class="bi bi-person-circle fs-5 text-primary"></i>
                            </div>
                            <div>
                                <div class="text-muted small lh-1">Session Speaker</div>
                                <div class="fw-bold text-dark">{{ $topic->speaker_name }}</div>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center p-3 rounded-4 bg-light border border-white">
                            <div class="flex-shrink-0 me-3">
                                <i class="bi bi-geo-alt-fill fs-5 text-danger"></i>
                            </div>
                            <div>
                                <div class="text-muted small lh-1">Venue</div>
                                <div class="fw-bold text-dark text-truncate" style="max-width: 180px;">{{ $topic->location ?? 'ยังไม่ระบุสถานที่' }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center p-3 rounded-4 bg-light border border-white">
                            <div class="flex-shrink-0 me-3">
                                <i class="bi bi-clock-fill fs-5 text-warning"></i>
                            </div>
                            <div>
                                <div class="text-muted small lh-1">Start Time</div>
                                <div class="fw-bold text-dark">{{ $topic->event_date->format('H:i') }} hrs</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 d-flex gap-2">
                        <a href="{{ route('topics.show', $topic) }}" class="btn btn-outline-primary rounded-pill fw-black py-3 px-4 shadow-primary-subtle flex-grow-1 d-flex align-items-center justify-content-center">
                            <span>DETAILS</span>
                        </a>
                        <form action="{{ route('registrations.destroy', $registration) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this registration?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger rounded-pill fw-black py-3 px-4 shadow-danger-subtle d-flex align-items-center justify-content-center" title="Cancel Registration">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 py-5 text-center">
            <div class="bg-white rounded-5 shadow-sm p-5 border-0 text-center">
                <div class="mb-5">
                    <div class="bg-light rounded-circle p-5 d-inline-flex justify-content-center align-items-center mx-auto" style="width: 150px; height: 150px;">
                        <i class="bi bi-calendar-x fs-1 text-muted opacity-50" style="font-size: 4rem !important;"></i>
                    </div>
                </div>
                <h2 class="fw-black text-dark mb-3">No Workshops Yet</h2>
                <p class="text-muted mb-5 fs-5 mx-auto" style="max-width: 600px;">Your learning dashboard is currently empty. Explore our upcoming sessions to kickstart your journey!</p>
                <a href="{{ route('welcome') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow-primary transition-300 fw-black">
                    EXPLORE ALL WORKSHOPS
                </a>
            </div>
        </div>
    @endforelse
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&display=swap');

h1, h2, h3, h4, .fw-black { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; letter-spacing: -0.02em; }

.text-gradient { background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.shadow-premium { box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
.shadow-primary { box-shadow: 0 10px 30px rgba(13, 110, 253, 0.3); }
.shadow-primary-subtle { box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2); }
.shadow-danger-subtle { box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2); }
.card-hover:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; }
.transition-300 { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.backdrop-blur { backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.space-y-3 > * + * { margin-top: 1rem; }
.inner-shadow-sm { box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); }
</style>
@endsection
