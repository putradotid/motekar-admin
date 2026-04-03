<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- SB Admin CSS -->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-light">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-4 col-lg-5 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">

                <div class="card-body p-0">

                    <div class="p-5">

                        <!-- TITLE -->
                        <div class="text-center">
                            <img 
                                src="{{ asset('storage/motekar-logo.png') }}"
                                class="img-fluid rounded-top"
                                alt="logo"
                            />
                        </div>

                        <!-- FORM -->
                        <form method="POST" action="#" class="user">
                            @csrf

                            <!-- ERROR -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <!-- EMAIL -->
                            <div class="form-group">
                                <input type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control form-control-user"
                                    placeholder="Enter Email Address..."
                                    required>
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-user"
                                    placeholder="Password"
                                    required>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit"
                                class="btn btn-user btn-block"
                                style="background-color:#ff6600; border-color:#ff6600; color:white;">
                                Login
                            </button>

                        </form>

                        <hr>

                        <!-- LINKS -->
                        <div class="text-center">
                            {{-- <a class="small" href="{{ route('register') }}"> --}}
                            <a class="small" href="#">
                                Create an Account!
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- JS SB Admin -->
<script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>