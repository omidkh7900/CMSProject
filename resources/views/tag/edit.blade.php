@extends('layouts.app')

@section('content')
    <form class="w-50 mx-auto" action="{{route('tag.update',['tag'=>$tag->Slug])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" value="{{$tag->Title}}" name="Title" id="title">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
