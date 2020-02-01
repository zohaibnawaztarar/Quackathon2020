@extends('layouts.master')

@section('title')
    Login
@endsection

@section('content')

    <!-- Bootstrap NavBar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{URL::to('landing')}}">
            <img src="images/favicon/" width="30" height="30" class="d-inline-block align-top" alt="">
            <span class="menu-collapsed">Quackathon</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                @if(Auth::User())
                    <li class="nav-item active">
                        <a class="nav-link" href="">Somewhere<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item" style="padding-left: 5px">
                        <button class="btn btn-danger my-2 my-sm-0" onclick="location.href = '{{route('logout')}}'">Logout</button>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="{{URL::to('/login')}}">Login <span class="sr-only">(current)</span></a>
                    </li>
                @endif
            </ul>
        </div>
    </nav><!-- NavBar END -->

    <br><br><br><br><br><br><br>

    <div class="container content">
        <div class="row">
            <div class="col-md-5">
                <h3>Login</h3>
                <form action="{{route('login')}}" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}"> <?php //protection against CSRF by fetching session token?>
                </form>
            </div>

            <div class="col-md-5 offset-md-2">
                <h3>Register</h3>
                <form action="{{route('register')}}" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" type="text" name="reg_email" id="reg_email" value="{{Request::old('email')}}"> <?php //maintain old inputs if validation fails ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control form-control {{$errors->has('name') ? 'is-invalid' : ''}}" type="text" name="name" id="name" value="{{Request::old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control form-control {{$errors->has('password') ? 'is-invalid' : ''}}" type="password" name="reg_password" id="reg_password" value="">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                    <input type="hidden" name="enc_master_key" value="something" id="enc_master_key">
                    <input type="hidden" name="master_iv" value="something" id="master_iv">
                    <input type="hidden" name="kek_salt" value="something" id="kek_salt">
                    <input type="hidden" name="master_hash" value="something" id="master_hash">
                    <input type="hidden" name="_token" value="{{Session::token()}}"> <?php //protection against CSRF by fetching session token ?>
                </form>
            </div>
        </div>
        <br>
    </div>
@endsection
