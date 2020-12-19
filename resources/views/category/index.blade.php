@extends('layouts.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-info float-left">home</a>
    <br>
    <br>
    @foreach($categories as $category)
        <div class="card d-inline-flex" style="width: 18rem;">
            @if(isset($category->image))
            <img src="{{asset(str_replace('public','storage',explode('app/', $category->image->Path)[1]))}}" class="card-img-top " alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$category->Title}}</h5>
                <a href="{{route('category.show',['category'=>$category->Slug])}}" class="btn btn-primary">show posts</a>
            </div>
        </div>
    @endforeach
@endsection
