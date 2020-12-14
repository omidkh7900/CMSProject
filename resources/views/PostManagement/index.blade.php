@extends('layouts.app')

@section('content')
    <a href="{{$withTrashed?route('PostManagement.index',['withTrashed'=>false])
                           :route('PostManagement.index',['withTrashed'=>true])}}" class="btn btn-info">
        {{$withTrashed?'posts':'trashed'}}</a>
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
                <td>@if(!$withTrashed)
                        <a href="{{route('PostManagement.show',['PostManagement'=>$post->id,'withTrashed'=>$withTrashed??false])}}"
                           class="btn btn-info">show</a>
                    @else
                        <form
                            action="{{route('PostManagement.destroy',['PostManagement'=>$post->id,'withTrashed'=>$withTrashed])}}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-danger">hard delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$posts->links()}}`
@endsection

