<div class="assets">
    <div class="assets card">
        <div class="card-header">
            <h5 class="card-title">Assets</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($lesson->assets as $asset)
                <li class="list-group-item">
                    <a target="_blank" href="{{ route('lessons.assets.show', [$lesson, $asset]) }}">{{ $asset->title }}</a>
                    <small class="text-muted">- {{ $asset->created_at->diffForHumans() }} door {{ $asset->author()->name }}</small>
                </li>
            @endforeach
        </ul>
    </div>
</div>