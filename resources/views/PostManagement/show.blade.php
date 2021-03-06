@extends('layouts.app')

@section('content')
    <a href="{{route('PostManagement.index')}}" class="btn btn-info float-left">Post list</a>
    <div class="w-25 mx-auto">
        <img src="{{asset(str_replace('public','storage',explode('app/', $post->image->Path)[1]))}}" width="250px"
             height="250px" alt="hi">
        <h4>title : {{$post->Title}}</h4>
        <h4>content : {{$post->Content}}</h4>
        <h4>slug : {{$post->Slug}}</h4>
        <h4>tags :
        @foreach($post->tags as $tag)
         #{{$tag->Title}}  @endforeach</h4>
        <h4>categories :
            @foreach($post->categories as $category)
                {{$category->Title}},  @endforeach</h4>
        <form action="{{route('PostManagement.update',['post'=>$post->id])}}" class="d-inline" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="published" value="{{$post->published?'0':'1'}}">
            <input type="submit" class="d-inline btn btn-info"
                   value="{{$post->published?"draft":"publish"}}">
        </form>
        <form action="{{route('PostManagement.destroy',['post'=>$post->id,'withTrashed'=>$withTrashed])}}"
              class="d-inline" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="d-inline btn btn-danger" value="delete">
        </form>
    </div>
@endsection
