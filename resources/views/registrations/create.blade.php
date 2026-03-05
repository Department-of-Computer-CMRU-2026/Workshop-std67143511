@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
            <div class="bg-primary bg-opacity-10 py-4 px-4 border-bottom border-primary border-opacity-25">
                <h3 class="fw-bold text-primary mb-1">{{ $topic->title }}</h3>
                <p class="text-muted mb-0"><i class="bi bi-clock"></i> {{ $topic->event_date->format('l, j F Y H:i') }} | Speaker: {{ $topic->speaker_name }}</p>
            </div>
            <div class="card-body p-4">
                <p class="text-secondary mb-4">{{ $topic->description }}</p>

                <h5 class="fw-bold mb-3 border-bottom pb-2">Registration Form</h5>
                
                <form action="{{ route('registrations.store', $topic) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="student_id" class="form-label fw-medium">Student ID (Optional)</label>
                        <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id') }}">
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="form-label fw-medium">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">Confirm Registration</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('welcome') }}" class="text-muted text-decoration-none">Cancel & Return to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
