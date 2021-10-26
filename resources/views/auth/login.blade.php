@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card mt-5 h-75 " dir="rtl">
                    <div class="bg-primary text-white card-header text-center">{{ __('تسجيل دخول الادمن') }}</div>

                    <div class="card-body">
                        <form method="POST" class="mt-5 mb-5" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكتروني') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group mt-5  mb-0">
                                <div class="col-md-8 offset-md-4 " style="margin-right: 150px">
                                    <button type="submit" class="btn-block btn btn-primary ">
                                        {{ __('تسجيل دخول') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
