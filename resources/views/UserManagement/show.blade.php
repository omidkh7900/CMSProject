@extends('layouts.app')

@section('content')
    <a href="{{route('UserManagement.index')}}" class="btn btn-info float-left">User list</a>
    <div class="w-50 mx-auto">
        <h4>name : {{$user->name}}</h4>
        <h4>email : {{$user->email}}</h4>
        <form action="{{route('UserManagement.update',['UserManagement'=>$user->id])}}" class="d-inline" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="activation" value="{{$user->activation?'0':'1'}}">
            <input type="submit" class="d-inline btn btn-info"
                   value="{{$user->activation?"activation":"deactivation"}}">
        </form>
        <form action="{{route('UserManagement.destroy',['UserManagement'=>$user->id])}}" class="d-inline" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="d-inline btn btn-danger" value="delete">
        </form>
    </div>
@endsection
