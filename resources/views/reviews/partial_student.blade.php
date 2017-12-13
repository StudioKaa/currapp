<div class="card">
    <div class="card-body">
        <h5 class="card-title">Studentversie:</h5>
        <p><a target="_blank" href="/reviews/{{ $review->id }}/sv">{{ ucfirst($review->sv_filename) }}</a></p>
    </div>
    <div class="card-footer text-muted">
        {{ $review->created_at->diffForHumans() }} door {{ $review->author()->name }}
    </div>
</div>