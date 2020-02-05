@extends('layouts.app')

@section('content')
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form action="{{ route('updateUser')}}">
        {{ csrf_field() }}
            <div class="form-row profile-row">
                <div class="col-md-4 relative">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div><input type="file" class="form-control" name="avatar-file">
                    <div class="form-group" style="margin-top: 31px;height: 84px;"><label>Bio</label><input class="form-control" type="text" name="lastname" value="{{ $user->getTagline() }}" style="height: 275px;"></div>
                </div>
                <div class="col-md-8">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Firstname </label><input class="form-control" type="text" name="firstname" value="{{$user->getFirstname()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Lastname</label><input class="form-control" type="text" name="lastname" value="{{$user->getLastname()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Username</label><input class="form-control" type="text" name="username" value="{{$user->getUsername()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>City</label><input class="form-control" type="text" name="city" value="{{$user->getCity()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>State</label><input class="form-control" type="text" name="state" value="{{$user->getState()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Birthday</label></div><input class="form-control" type="date" value="{{$user->getBirthday()}}"style="margin-top: -17px;"></div>
                    </div>
                    <div class="form-group"><label>Email </label><input class="form-control" type="email" autocomplete="off" required="" name="email" value="{{$user->getEmail()}}"></div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Password </label><input class="form-control" type="password" name="password" autocomplete="off" required="" value="{{$user->getPassword()}}"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirm Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" required=""></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit">SAVE </button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection