@extends('layout')
@section('content')
<br>
<br>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <br><br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td><h5>User ID</h5></td>
                        <td><h5>Name</h5></td>
                        <td><h5>Profile Image</h5></td>
                        <td><h5>Email</h5></td>
                        <td><h5>Role</h5></td>
                        <td><h5>Gender</h5></td>
                        <td><h5>Created Time</h5></td>

                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td><img src="{{ $user->avatar }}" width="100" class="" alt="">
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->created_at}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <strong style="color: red;">Note:</strong>
<b>For role, Admin is 1 && User is 2</b>
        <br>
    </div>
    <div class="col-sm-2"></div>
</div>
@endsection
