
<div class="links-container">
<h5>
    <span>Benodigde links</span>
    <a href="/links/create?lesson={{ $lesson->id }}" class="btn btn-outline-secondary">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>
</h5>
@if(count($lesson->links))
<div class="files">
    <div class="files card">
        <ul class="list-group list-group-flush">
            @foreach($lesson->links as $link)
                <li class="list-group-item link-item">
                    <a class="" target="_blank" href="{{ $link->link }}" >
                        {{ $link->title }}

                    </a>
                    @if(\Auth::user()->type == 'teacher')
                        <i style="cursor:pointer" onclick="document.getElementById('removeLink-{{$link->id}}').submit()" class="fa fa-trash-o"></i>
                        <form style="display:none" id="removeLink-{{$link->id}}" action="{{action('LinkController@destroy', $link->id)}}" method="POST">
                            <input type="hidden" value="delete" name="_method">
                            {{csrf_field()}}
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
</div>