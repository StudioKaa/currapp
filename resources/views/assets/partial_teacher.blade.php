<div class="btn-group asset-buttons">
    <span class="btn btn-outline-secondary">Nieuw:</span>
    <a class="btn btn-outline-secondary" href="{{ route('lessons.assets.create.file', $lesson->id) }}" class="btn"><i class="fa fa-file-text-o"></i> <span>bestand</span></a>
    <a class="btn btn-outline-secondary" href="{{ route('lessons.assets.create.link', $lesson->id) }}" class="btn"><i class="fa fa-link"></i> <span>link</span></a>
</div>

@if($lesson->assets->isNotEmpty())
<div class="assets">
    <div class="card">
        <ul class="list-group list-group-flush">
            @foreach($lesson->assets as $asset)
                <li class="list-group-item">
                    <a target="_blank" href="{{ $asset->link }}">{{ $asset->title }}</a>
                    <small class="text-muted">- {{ $asset->created_at->diffForHumans() }} door {{ $asset->author()->name }}</small>
                    @if($asset->visibility == 'student')
                        <span class="badge badge-secondary">SV</span>
                    @endif
                    <a href="{{ route('lessons.assets.delete', [$lesson, $asset]) }}" class="pull-right"><i class="fa fa-trash"></i></a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif