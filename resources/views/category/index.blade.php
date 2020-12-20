@extends('layouts.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-info float-left">home</a>
    @role('super-admin')
    <a href="{{route('category.create')}}" class="btn btn-info ml-2 float-left">create category</a>
    @endrole
    <br>
    <br>
    @foreach($categories as $category)
        <div class="card d-inline-flex" style="width: 18rem;">
            @if(isset($category->image))
            <img src="{{asset(str_replace('public','storage',explode('app/', $category->image->Path)[1]))}}" class="card-img-top " alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$category->Title}}</h5>
                <a href="{{route('category.show',['category'=>$category->Slug])}}" class="btn btn-success">show posts</a>
                @role('super-admin')
                <a href="{{route('category.edit',['category'=>$category->Slug])}}" class="btn btn-primary">edit</a>
                <form action="{{route('category.destroy',['category'=>$category->Slug])}}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="submit" onclick="return confirm('are you sure?')" value="delete" class="btn btn-danger">
                </form>
                @endrole
            </div>
        </div>
    @endforeach
@endsection
