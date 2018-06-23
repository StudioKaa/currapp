<div class="card border-{{ $revision->status->class }}">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h5 class="review-link card-title">
                <a target="_blank" href="{{ route('revisions.get.wv', $revision) }}">{{ ucfirst($revision->wv_title) }}</a>
            </h5>
            <div class="review-link-after">
                <span class="badge badge-{{ $revision->status->class }}">WV</span>
            </div>
        </li>
        <li class="list-group-item">
            @if($revision->tv_title == null)
                <a class="review-link" href="/reviews/{{ $revision->id }}/addfiles">(Trainersversie toevoegen)</a>
                <div class="review-link-after">
                    <span class="badge badge-danger">TV</span>
                </div>
            @else
                <a class="review-link" target="_blank" href="{{ route('revisions.get.tv', $revision) }}">{{ $revision->tv_title }}</a>
                <div class="review-link-after">
                    <span class="badge badge-{{ $revision->status->class }}">TV</span>
                </div>
            @endif
        </li>
        <li class="list-group-item">
            @if($revision->sv_title == null)
                <a class="review-link" href="/reviews/{{ $revision->id }}/addfiles">(Studentversie toevoegen)</a>
                <div class="review-link-after">
                    <span class="badge badge-danger">SV</span>
                </div>
            @else
                <a class="review-link" target="_blank" href="{{ route('revisions.get.sv', $revision) }}">{{ $revision->sv_title }}</a>
                <div class="review-link-after">
                    <span class="badge badge-{{ $revision->status->class }}">SV</span>
                </div>
            @endif
        </li>
    </ul>
    <div class="card-footer text-muted border-top-0">
        {{ $revision->status->title }} ({{ $revision->created_at->diffForHumans() }} door {{ $revision->author()->name }})
    </div>
</div>
