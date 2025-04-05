@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2 fs-4"></i>
        <div>
            <h6 class="mb-1 fw-bold">Success!</h6>
            <p class="mb-0">{{ session('success') }}</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
        <div>
            <h6 class="mb-1 fw-bold">Oops!</h6>
            <p class="mb-0">{{ session('error') }}</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-octagon-fill me-2 fs-4"></i>
        <div>
            <h6 class="mb-1 fw-bold">Please fix these issues:</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif