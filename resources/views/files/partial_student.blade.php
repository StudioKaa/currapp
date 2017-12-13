<div class="files">
    <div class="files card">
        <div class="card-header border-bottom-0">
            <h5 class="card-title">Losse bestandennnn</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($files as $file)
                <li class="list-group-item">
                    <a target="_blank" href="/files/{{ $file->id }}" >
                        {{ $file->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>