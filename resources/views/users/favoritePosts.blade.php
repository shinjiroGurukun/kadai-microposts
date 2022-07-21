
@if (count($favoritePosts) > 0)
    <ul class="list-unstyled">
        @foreach ($favoritePosts as $favoritePost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($favoritePost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $favoritePost->user->name, ['user' => $favoritePost->user->id]) !!}
                        <span class="text-muted">posted at {{ $favoritePost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($favoritePost->content)) !!}</p>
                    </div>
                    <div class="row">
                        @if (Auth::id() == $favoritePost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $favoritePost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        @if(Auth::user()->is_favorite($favoritePost->id))
                        {{-- いいねボタン外すのフォーム --}}
                            {!! Form::open(['route' => ['favorites.unfavorite', $favoritePost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Unfavorite', ['class' => "btn btn-sm btn-primary"]) !!}
                            {!! Form::close() !!}
                        @else
                        {{-- いいねするボタンのフォーム --}}
                            {!! Form::open(['route' => ['favorites.favorite', $favoritePost->id]]) !!}
                                {!! Form::submit('Favorite', ['class' => "btn btn-sm btn-success"]) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $favoritePosts->links() }}
@endif