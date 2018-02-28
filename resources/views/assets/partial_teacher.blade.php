    <h5>Assets</h5>
    <div class="btn-group">
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
                    <a target="_blank" href="{{ $asset->link }}" >
                        {{ $asset->title }}
                    </a>
                    <a href="/files/{{ $asset->id }}/delete" class="pull-right"><i class="fa fa-trash"></i></a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif