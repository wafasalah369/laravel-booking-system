@if(session('success'))
<div class="position-relative mx-auto my-3 px-4 py-3 alert alert-success shadow-sm rounded d-flex align-items-start justify-content-between" style="max-width: 900px;">
    <div class="d-flex align-items-start">
        <i class="bi bi-check-circle-fill text-success me-3 fs-4 mt-1"></i>
        <div>
            <h6 class="fw-bold mb-1">Success!</h6>
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="position-relative mx-auto my-3 px-4 py-3 alert alert-danger shadow-sm rounded d-flex align-items-start justify-content-between" style="max-width: 900px;">
    <div class="d-flex align-items-start">
        <i class="bi bi-exclamation-triangle-fill text-danger me-3 fs-4 mt-1"></i>
        <div>
            <h6 class="fw-bold mb-1">Oops!</h6>
            <p class="mb-0">{{ session('error') }}</p>
        </div>
    </div>
    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="position-relative mx-auto my-3 px-4 py-3 alert alert-danger shadow-sm rounded d-flex align-items-start justify-content-between" style="max-width: 900px;">
    <div class="d-flex align-items-start">
        <i class="bi bi-exclamation-octagon-fill text-danger me-3 fs-4 mt-1"></i>
        <div>
            <h6 class="fw-bold mb-2">Please fix these issues:</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
