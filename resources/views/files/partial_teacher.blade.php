<div class="files-container">
<h5>
    <span>Losse bestanden</span>
    <a href="/files/create?lesson={{ $lesson->id }}" class="btn btn-outline-secondary">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>
</h5>
@if($files->isNotEmpty())
<div class="files">
    <div class="files card">
        <ul class="list-group list-group-flush">
            @foreach($files as $file)
                <li class="list-group-item">
                    <a target="_blank" href="/files/{{ $file->id }}" >
                        {{ $file->title }}
                    </a>
                    <a href="/files/{{ $file->id }}/delete" class="pull-right"><i class="fa fa-trash"></i></a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

</div>
