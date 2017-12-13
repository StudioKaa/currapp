<div class="card border-{{ $review->status()->context_class }}">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h5 class="card-title d-flex justify-content-between align-items-center">
                <a target="_blank" href="/reviews/{{ $review->id }}/wv">{{ ucfirst($review->wv_filename) }}</a>
                <span class="badge badge-{{ $review->status()->context_class }}">WV</span>
            </h5>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            @if($review->tv_filename == null)
                <a class="ml-3" href="/reviews/{{ $review->id }}/edit">(Trainersversie toevoegen)</a>
                <span class="badge badge-danger">TV</span>
            @else
                <a class="ml-3" target="_blank" href="/reviews/{{ $review->id }}/tv">{{ $review->tv_filename }}</a>
                <span class="badge badge-{{ $review->status()->context_class }}">TV</span>
            @endif
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            @if($review->sv_filename == null)
                <a class="ml-3" href="/reviews/{{ $review->id }}/edit">(Studentversie toevoegen)</a>
                <span class="badge badge-danger">SV</span>
            @else
                <a class="ml-3" target="_blank" href="/reviews/{{ $review->id }}/sv">{{ $review->sv_filename }}</a>
                <span class="badge badge-{{ $review->status()->context_class }}">SV</span>
            @endif
        </li>
    </ul>
    <div class="card-body">
        @if($review->comment != null && $review->status()->title != 'Compleet')
            <p>
                <span class="text-muted">{{ $review->reviewer()->name }}: </span>
                {{ $review->comment }}
            </p>
        @endif
        <div class="btn-group review-buttons">
            @if($review->status()->title == 'Concept' || $review->status()->title == 'In-review')
                <a href="/reviews/{{ $review->id }}/review" class="card-link btn btn-outline-primary"><i class="fa fa-eye"></i> Reviewen</a>
            @endif
        </div>
    </div>
    <div class="card-footer text-muted">
        {{ $review->status()->title }} ({{ $review->created_at->diffForHumans() }} door {{ $review->author()->name }})
    </div>
</div>