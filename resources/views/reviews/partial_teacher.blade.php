<div class="card border-{{ $review->status()->context_class }}">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h5 class="review-link card-title">
                <a target="_blank" href="/reviews/{{ $review->id }}/wv">{{ ucfirst($review->wv_filename) }}</a>
            </h5>
            <div class="review-link-after">
                <span class="badge badge-{{ $review->status()->context_class }}">WV</span>
            </div>
        </li>
        <li class="list-group-item">
            @if($review->tv_filename == null)
                <a class="review-link" href="/reviews/{{ $review->id }}/addfiles">(Trainersversie toevoegen)</a>
                <div class="review-link-after">
                    <span class="badge badge-danger">TV</span>
                </div>
            @else
                <a class="review-link" target="_blank" href="/reviews/{{ $review->id }}/tv">{{ $review->tv_filename }}</a>
                <div class="review-link-after">
                    <span class="badge badge-{{ $review->status()->context_class }}">TV</span>
                </div>
            @endif
        </li>
        <li class="list-group-item">
            @if($review->sv_filename == null)
                <a class="review-link" href="/reviews/{{ $review->id }}/addfiles">(Studentversie toevoegen)</a>
                <div class="review-link-after">
                    <span class="badge badge-danger">SV</span>
                </div>
            @else
                <a class="review-link" target="_blank" href="/reviews/{{ $review->id }}/sv">{{ $review->sv_filename }}</a>
                <div class="review-link-after">
                    <span class="badge badge-{{ $review->status()->context_class }}">SV</span>
                </div>
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