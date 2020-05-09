<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Login</title>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <link rel=”canonical” href="{{url('/')}}"/>
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" media="screen">

    <style>
        .justify-content-center {
            display: flex;
            justify-content: center;
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0,0,0,.03);
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }
        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
        @media (min-width: 768px){
            .offset-md-4 {
                margin-left: 33.333333%;
            }
        }

    </style>

</head>
<body>
<header class="section header">
    <div class="container">

        <a class="logo-brand" href="{{url('/')}}">appnaz</a>
        <div class="right w-30 searh-box dis-flex">
            <input class="search-input" type="search" placeholder="Keyword..."/>
            <button type="submit" class="btn">Search</button>
        </div>
    </div>
</header>
    <div class="container">
        <div class="col-xs-12 empty-space" style="height: 150px;">

        </div>
        <div class="row justify-content-center">
            <div class="col-xs-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="u-mb-medium">Login to Appnaz.com</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="email"
                                           placeholder="example@domain.com" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="password"
                                           placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

