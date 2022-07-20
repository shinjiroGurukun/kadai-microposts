    @if(Auth::user()->is_favorite($micropost->id))
        {{-- いいねボタン外すのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-sm btn-success"]) !!}
        {!! Form::close() !!}
    @else
        {{-- いいねするボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-sm btn-primary"]) !!}
        {!! Form::close() !!}
    @endif