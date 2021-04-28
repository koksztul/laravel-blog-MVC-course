@extends('layouts.master')
@section('title', $post->title)

@section('content')
@if ($post->type == 'text')
<article class="post formatText">
    <div class="postContent">
        <div class="wrapper">
            <h2 class="postTitle">
                <a href="#">{{ $post->title }}</a>
            </h2>
            <div class="rte">
                {!! $post->content !!}
                <p class="readMore">
                    <a href="#">Keep reading</a>
                </p>
            </div>
        </div>
    </div>
    <div class="meta">
        @if($post->tags->count() > 0)
        <ul class="tags">
            <li><i class="fa fa-tags"></i></li>
            @foreach ($post->tags as $tag)
            <li>
                <a href="{{ route('posts.tags', $tag->slug) }}">{{ $tag->name }}</a>
            </li>
            @endforeach
        </ul>
        @endif
        <div class="flex flex-sb">
            <p class="date"><i class="fa fa-clock-o"></i> {{ $post->date->diffForHumans() }} <i class="fa fa-user"> by {{ $post->author->name }}</i></p>
            @can('manage-posts')
            <p>
                <a href="{{ route('admin.post.edit', $post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
            </p>
            @endcan
        </div>
    </div>
</article>
@elseif ($post->type == 'photo')
<article class="post formatPhoto">
    <figure class="postImage">
        @if ($post->premium)
        <i class="postPremium fa fa-star"></i>
        @endif
        <a href="#">
        <img src="{{ $post->photo }}" alt="" class="mainPhoto">
        </a>
        <div class="cover"
            style="background: url({{ $post->photo }}) no-repeat;">
        </div>
    </figure>
    <div class="meta">
        @if($post->tags->count() > 0)
        <ul class="tags">
            <li><i class="fa fa-tags"></i></li>
            @foreach ($post->tags as $tag)
            <li>
                <a href="{{ route('posts.tags', $tag->slug) }}">{{ $tag->name }}</a>
            </li>
            @endforeach
        </ul>
        @endif
        <div class="flex flex-sb">
            <p class="date"><i class="fa fa-clock-o"></i> {{ $post->date->diffForHumans() }} <i class="fa fa-user"> by {{ $post->author->name }}</i></p>
            @can('manage-posts')
            <p>
                <a href="{{ route('admin.post.edit', $post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
            </p>
            @endcan
        </div>
    </div>
</article>
<article class="post formatText">
    <div class="postContent">
        <div class="wrapper">
            @if ($post->premium)
            <i class="postPremium fa fa-star"></i>
            @endif
            <h2 class="postTitle">
                <a href="#">{{ $post->title }}.</a>
            </h2>
            <div class="rte">
                {{ $post->content }}
            </div>
        </div>
    </div>
    <div class="meta">
        @if($post->tags->count() > 0)
        <ul class="tags">
            <li><i class="fa fa-tags"></i></li>
            @foreach ($post->tags as $tag)
            <li>
                <a href="{{ route('posts.tags', $tag->slug) }}">{{ $tag->name }}</a>
            </li>
            @endforeach
        </ul>
        @endif
        <div class="flex flex-sb">
            <p class="date"><i class="fa fa-clock-o"></i> {{ $post->date->diffForHumans() }} <i class="fa fa-user"> by {{ $post->author->name }}</i></p>
            @can('manage-posts')
            <p>
                <a href="{{ route('admin.post.edit', $post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
            </p>
            @endcan
        </div>
    </div>
</article>
<div class="wrapper">
    <div class="pagination">
        <a href="//larablogger.test:3002/?p=1" class="paginationPrev" title="Previous">
            <i class="fa fa-caret-left"></i>&nbsp;&nbsp;&nbsp;Previous
        </a>
        <a href="#" class="paginationNext" title="Next">
        Next&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
        </a>
    </div>
</div>
@endif
<section class="comments">
    <div class="wrapper">
        @if($post->comments->count() > 0)
        <div class="rte">
            <h2>{{ $post->comments->count() }} {{ $post->comments->count() > 1 ? 'Comments' : 'Comment' }}</h2>
        </div>
        <div class="comments-list">
            @foreach ($post->comments as $comment)
            <article class="comment">
                <div class="comment-meta">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $comment->author->name }}" class="comment-avatar">
                    <span class="comment-user">{{ $comment->author->name }}</span>
                    <span class="comment-date">{{ $comment->date->format('d.m.Y') }}</span>
                </div>
                <p class="comment-body rte">{{ $comment->content }}</p>
            </article>
            @endforeach
        </div>
        <div class="comments-add">
            <div class="rte">
                <h2>Add comment</h2>
            </div>
            <form method="POST" action="{{ route('comment.create') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-fieldset is-full">
                    <textarea name="content" class="form-textarea {{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="Your comment">{{ old('content') }}</textarea>
                </div>
                <button class="button">Submit</button>
            </form>
        </div>
        @endif
    </div>
</section>
@endsection