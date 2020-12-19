@extends('layouts.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-info float-left d-block">home</a>
    <table class="table table-striped table-dark w-25 mx-auto">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->Title}}</td>
                <td><a href="{{route('tag.show',['tag'=>$tag->Slug])}}" class="btn btn-info">show</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

