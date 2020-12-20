@extends('layouts.app')

@section('content')
    <form class="w-50 mx-auto" action="{{route('category.update',['category'=>$category->Slug])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            @if(isset($category->image))
                <img src="{{asset(str_replace('public','storage',explode('app/', $category->image->Path)[1]))}}" class="w-50 mx-auto d-block bg-dark" alt="...">
            @endif
            <label for="title">title</label>
            <input type="text" class="form-control" value="{{$category->Title}}" name="Title" id="title">
            <label for="image">change image</label>
            <input type="file" name="image" class="mt-3" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
