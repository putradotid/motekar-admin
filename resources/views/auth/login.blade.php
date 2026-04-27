<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('storage/motekar-logo.ico') }}" type="image/x-icon">
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
                        <form class="user" id="loginForm">
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
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control form-control-user"
                                    placeholder="Enter Email Address..."
                                    required>
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">
                                <input type="password"
                                    id="password"
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
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('register') }}">
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

<script>
    document.getElementById('loginForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch('http://localhost:8000/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json'
                },
                body: JSON.stringify({ email, password})
            });

            const data = await response.json();

            if (response.ok) {
                // simpan token
                localStorage.setItem('token', data.token);

                // pindah page sesuai role
                if (data.user.role === 'admin') {
                    window.location.href = '/admin/dashboard';
                } else {
                    window.location.href = '/user/meeting';
                }
            } else {
                alert(data.message || 'Login gagal');
            }
        } catch (error) {
            console.error(error);
        }
    });

</script>

</body>
</html>