@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 ps-4">
                <h3 class="fw-bold text-dark mb-0">Create New Topic</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('topics.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label fw-medium">Topic Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-medium">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="speaker_name" class="form-label fw-medium">Speaker Name</label>
                            <input type="text" class="form-control @error('speaker_name') is-invalid @enderror" id="speaker_name" name="speaker_name" value="{{ old('speaker_name') }}" required>
                            @error('speaker_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-label fw-medium">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="seat_limit" class="form-label fw-medium">Seat Limit</label>
                            <input type="number" class="form-control @error('seat_limit') is-invalid @enderror" id="seat_limit" name="seat_limit" value="{{ old('seat_limit') }}" min="1" required>
                            @error('seat_limit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="event_date" class="form-label fw-medium">Event Date</label>
                            <input type="datetime-local" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                            @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('topics.index') }}" class="btn btn-light me-2 rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Save Topic</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
