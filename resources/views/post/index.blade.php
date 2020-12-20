@extends('layouts.app')

@section('content')
    <a href="{{route('post.index',[\App\Models\Post::STATUS=>\App\Models\Post::STATUS_DELETED])}}" class="btn btn-danger">deleted</a>
    <a href="{{route('post.index',[\App\Models\Post::STATUS=>\App\Models\Post::STATUS_PUBLISHED])}}" class="btn btn-success">published posts</a>
    <a href="{{route('post.index',[\App\Models\Post::STATUS=>\App\Models\Post::STATUS_UNPUBLISHED])}}" class="btn btn-info">unpublished posts</a>

    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Slug</th>
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
                <td>@if(${\App\Models\Post::STATUS}==\App\Models\Post::STATUS_PUBLISHED ||
                        ${\App\Models\Post::STATUS}==\App\Models\Post::STATUS_UNPUBLISHED )
                        <a href="{{route('post.show',['post'=>$post->id])}}"
                           class="btn btn-info">show</a>
                    @else
                        <form
                            action="{{route('post.forceDelete',['post'=>$post->id])}}"
                            method="post"
                            class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-danger">hard
                                delete
                            </button>
                        </form>
                        <form
                            action="{{route('post.restore',['post'=>$post->id])}}"
                            method="post"
                            class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info">restore</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

