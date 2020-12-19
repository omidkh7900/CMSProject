@extends('layouts.app')

@section('content')
    <a href="{{route('category.index')}}" class="btn btn-info float-left">categories</a>
    <br>
    <br>
    @foreach($posts as $post)
        <div class="card d-inline-flex mx-3" style="width: 18rem;">
            <img src="{{asset(str_replace('public','storage',explode('app/', $post->image->Path)[1]))}}" class="card-img-top " alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->Title}}</h5>
                <h5>content : {{$post->Content}}</h5>
                <a href="{{route('post.show',['post'=>$post->id])}}" class="btn btn-primary">show</a>
            </div>
        </div>
    @endforeach
@endsection
