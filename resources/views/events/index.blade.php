@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="fw-bold">Upcoming Events</h1>
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-filter me-1"></i> Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Events</a></li>
                <li><a class="dropdown-item" href="#">Available Only</a></li>
            </ul>
        </div>
    </div>

    @include('partials.notifications')

    <div class="row g-4">
        @foreach($events as $event)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge rounded-pill bg-{{ $event->availableSeats() > 0 ? 'success' : 'danger' }} px-3 py-2 d-flex align-items-center">
                            <i class="bi bi-{{ $event->availableSeats() > 0 ? 'check-circle' : 'x-circle' }} me-1"></i>
                            {{ $event->availableSeats() > 0 ? 'Available' : 'Sold Out' }}
                        </span>
                        <small class="text-muted">
                            <i class="bi bi-people-fill me-1"></i> {{ $event->availableSeats() }}/{{ $event->capacity }}
                        </small>
                    </div>

                    <h4 class="card-title fw-bold">{{ $event->title }}</h4>
                    <p class="card-text text-muted mb-4">{{ Str::limit($event->description, 120) }}</p>

                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light p-3 rounded me-3 text-center">
                            <div class="fw-bold text-primary">{{ $event->start_time->format('M') }}</div>
                            <div class="fs-5 fw-bold">{{ $event->start_time->format('d') }}</div>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $event->start_time->format('l, g:i A') }}</div>
                            <small class="text-muted">{{ $event->end_time->format('g:i A') }} end</small>
                        </div>
                    </div>

                    @if($event->availableSeats() > 0)
                        <form method="POST" action="{{ route('events.book', $event) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-ticket-perforated me-2"></i> Book Now
                            </button>
                        </form>
                    @else
                        <button class="btn btn-outline-secondary w-100" disabled>
                            <i class="bi bi-x-circle me-2"></i> Fully Booked
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

<div class="d-flex flex-column align-items-center py-4">
    {{-- Pagination Info --}}
    <p class="text-muted mb-3">
        Showing <span class="fw-semibold">{{ $events->firstItem() }}</span> to 
        <span class="fw-semibold">{{ $events->lastItem() }}</span> of 
        <span class="fw-semibold">{{ $events->total() }}</span> events
    </p>
    
    {{-- Pagination Links --}}
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            {{-- Previous Page --}}
            <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $events->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&lsaquo;</span>
                </a>
            </li>

            {{-- Page Numbers --}}
            @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $events->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Page --}}
            <li class="page-item {{ !$events->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $events->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&rsaquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Toast
    const toastEl = document.querySelector('.toast');
    const toast = new bootstrap.Toast(toastEl);
    
    // Listen for booking notifications
    window.Echo.channel('bookings')
        .listen('BookingCreated', (data) => {
            document.querySelector('.toast-body').textContent = data.message;
            toast.show();
            setTimeout(() => toast.hide(), 5000);
        });
</script>
@endpush