<div class="card my-spacing">
    <div class="card-body">
        <h5 class="card-title">Losse bestanden:</h5>
        <ul>
            @foreach($files as $file)
                <li><a target="_blank" href="/files/{{ $file->id }}">{{ $file->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>