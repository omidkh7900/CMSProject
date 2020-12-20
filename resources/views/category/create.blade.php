@extends('layouts.app')

@section('content')
    <form class="w-50 mx-auto" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" name="Title" id="title">
            <label for="image">image</label>
            <input type="file" name="image" class="mt-3" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
