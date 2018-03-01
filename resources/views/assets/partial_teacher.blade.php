<div class="btn-group asset-buttons">
    <span class="btn btn-outline-secondary">Nieuw:</span>
    <a class="btn btn-outline-secondary" href="{{ route('lessons.assets.create.file', $lesson->id) }}" class="btn"><i class="fa fa-file-text-o"></i> bestand</a>
    <a class="btn btn-outline-secondary" href="{{ route('lessons.assets.create.link', $lesson->id) }}" class="btn"><i class="fa fa-link"></i> link</a>
</div>

@if($lesson->assets->isNotEmpty())
<div class="assets">
    <div class="assets card">
        <ul class="list-group list-group-flush">
            @foreach($lesson->assets as $asset)
                <li class="list-group-item">
                    <a target="_blank" href="{{ route('lessons.assets.show', [$lesson, $asset]) 
                }}">{{ $asset->title }}</a>
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