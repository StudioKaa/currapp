<div class="card">
    <div class="card-header">
        <h5 class="card-title">Reader</h5>
    </div>
    <div class="card-body">
        <p>
            <a target="_blank" href="/reviews/{{ $review->id }}/sv">{{ ucfirst($review->sv_filename) }}</a>
            <small class="text-muted">- {{ $review->created_at->diffForHumans() }} door {{ $review->author()->name }}</small>
        </p>
    </div>
</div>
