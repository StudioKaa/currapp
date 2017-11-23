<div class="card my-spacing">
    <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0">Losse bestanden</h5>
        <a href="/files/create?lesson={{ $lesson->id }}" class="btn btn-outline-secondary"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
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