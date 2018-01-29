<div class="files card">
    <div class="card-header border-bottom-0">
        <h5 class="card-title">Benodigde links</h5>
    </div>
    <ul class="list-group list-group-flush">
        @foreach($lesson->links as $link)
            <li class="list-group-item">
                <a target="_blank" href="{{$link->link}}" >
                    {{ $link->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>