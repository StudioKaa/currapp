<div class="card">
    <div class="card-header">
        <h5 class="card-title">Reader</h5>
    </div>
    <div class="card-body">
        <h6>Studentenversie:</h6>
        <p><a target="_blank" href="/reviews/{{ $review->id }}/sv">{{ ucfirst($review->sv_filename) }}</a></p>
    </div>
    <div class="card-footer text-muted">
        {{ $review->created_at->diffForHumans() }} door {{ $review->author()->name }}
    </div>
</div>
