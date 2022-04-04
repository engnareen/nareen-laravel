@extends('layouts.front')

@section('content')

<div class="article" id="articles">
    <h2 class="main-title">Articles</h2>
    <div class="container">
        @foreach($articles as $article)

        <div class="box">
            <img src="{{ asset('uploads/Articles/'. $article->image_path)  }}" alt="">
            <div class="content">
                <h3>{{ $article->title }}</h3>
                <p>{{ $article->summary}}</p>
            </div>
            <div class="info">
                <a href="{{ $article->description }}">Read More</a>
                <i class="fas fa-long-arrow-alt-right"></i>
            </div>
        </div>
        @endforeach

    </div>
</div>



@endsection
