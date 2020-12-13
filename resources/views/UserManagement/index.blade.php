@extends('layouts.app')

@section('content')
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><a href="{{route('UserManagement.show',['UserManagement'=>$user->id])}}" class="btn btn-info">show</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection

