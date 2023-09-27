<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin ATK</title>
    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{url('asset/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{url('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{url('asset/dist/css/adminlte.min.css') }}">
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>ATK</b>Gruop</a>
            </div>

            <div class="card-body">                    
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                       
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                                                
                    <div class="col-12-mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>    
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{url('asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{url('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('asset/dist/js/adminlte.min.js?v=3.2.0') }} "></script>
</body>
</html>


