<div class="card">
    <div class="card-header">
        <h5 class="card-title">Reader</h5>
    </div>
    <div class="card-body">
        <p>
            <a target="_blank" href="{{ route('revisions.get.sv', $revision) }}">{{ ucfirst($revision->sv_filename) }}</a>
            <small class="text-muted">- {{ $revision->created_at->diffForHumans() }} door {{ $revision->author()->name }}</small>
        </p>
    </div>
</div>
