@extends('layouts.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-info float-left d-block">home</a>
    @role('super-admin')
    <a href="{{route('tag.create')}}" class="btn btn-info ml-1 float-left d-block">create tag</a>
    @endrole
    <table class="table table-striped table-dark w-50 mx-auto">
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
                <td><a href="{{route('tag.show',['tag'=>$tag->Slug])}}" class="btn btn-info">show</a>
                    @role('super-admin')
                    <a href="{{route('tag.edit',['tag'=>$tag->Slug])}}" class="btn btn-info mr-1 float-left d-block">edit</a>
                    <form action="{{route('tag.destroy',['tag'=>$tag->Slug])}}" class="d-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" onclick="return confirm('are you sure')" class="btn btn-danger">
                    </form>
                    @endrole
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

