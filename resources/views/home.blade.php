@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<table class="table table-striped table-dark w-25 float-right">
    <thead>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>post count</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
    <tr>
        <th>{{$category->id}}</th>
        <td>{{$category->Title}}</td>
        <td>{{$category->posts->count()}}</td>
        <td><a href="{{route('category.show',['category'=>$category->Slug])}}" class="btn btn-info">show</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-striped table-dark w-25 mr-4 float-left">
    <thead>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>post count</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
        <tr>
            <th>{{$tag->id}}</th>
            <td>{{$tag->Title}}</td>
            <td>{{$tag->posts->count()}}</td>
            <td><a href="{{route('tag.show',['tag'=>$tag->Slug])}}" class="btn btn-info">show</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-striped table-dark w-25">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Slug</th>
        <th scope="col">tags</th>
        <th scope="col">categories</th>
        <th scope="col">action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->Title}}</td>
            <td>{{$post->Content}}</td>
            <td>{{$post->Slug}}</td>
            <td>
                @foreach($post->tags as $tag)#{{$tag->Title}} @endforeach</td>
            <td>
                @foreach($post->categories as $category){{$category->Title}}, @endforeach</td>
            <td><a href="{{route('post.show',['post'=>$post->id])}}"
                       class="btn btn-info">show</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$posts->links()}}`
@endsection
