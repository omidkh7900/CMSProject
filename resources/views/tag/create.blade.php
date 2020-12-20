@extends('layouts.app')

@section('content')
    <form class="w-50 mx-auto" action="{{route('tag.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" name="Title" id="title">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
