@props([
    'offcanvasId' => 'offcanvasShowDetails',
    'labelId' => 'offcanvasShowDetailsLabel',
    'bodyId' => 'show-details-offcanvas-body',
    'loadingId' => 'show-details-loading',
    'contentId' => 'show-details-content',
    'title' => 'Details',
    'placement' => 'end',
    'class' => ''
])

<div class="offcanvas offcanvas-{{ $placement }} {{ $class }}" tabindex="-1" id="{{ $offcanvasId }}" aria-labelledby="{{ $labelId }}">
    <div class="offcanvas-header border-bottom">
        <h5 id="{{ $labelId }}" class="offcanvas-title">{{ $title }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 h-100" id="{{ $bodyId }}">
        <div class="text-center py-5" id="{{ $loadingId }}" style="display:none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div id="{{ $contentId }}">
            {{ $slot }}
        </div>
    </div>
</div>


