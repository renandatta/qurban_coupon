@extends('layouts.main')

@section('title')
    Login -
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                    <h4>{{ env('APP_NAME') }}</h4>
                    <br>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email login" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="******" required>
                            </div>

                            <a href="{{ route('home') }}" class="btn btn-block btn-primary">Login</a>
                            <hr>
                            <h6 class="text-center">Untuk informasi lebih lanjut hubungi <br> <a href="mailto:renandattarooziq@gmail.com">renandattarooziq@gmail.com</a></h6>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
