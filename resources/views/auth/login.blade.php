@extends('templates.login')

@push('styles-page-specific')
    @css('pryordnd/pages/login.css')
@endpush

@section('body-content')
<div class="login-container">
    <div class="grid-container">
        <div class="grid-x grid-padding-x grid-padding-y align-center-middle">
            <div class="cell large-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="">
                        <label for="username" class="col-md-4 col-form-label text-md-right">
                            {{ __('Username') }}
                        </label>

                        <div class="">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="email" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="">
                        <label for="password" class="col-md-4 col-form-label text-md-right">
                            {{ __('Password') }}
                        </label>

                        <div class="">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{--<div class="">
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>--}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
