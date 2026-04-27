<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('storage/motekar-logo.ico') }}" type="image/x-icon">
    <title>Register</title>

    <!-- SB Admin CSS -->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-light">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center bg-register-image">
                        <img 
                            src="{{ asset('storage/motekar-logo.png') }}"
                            alt="logo"
                            style="max-width: 400px; height: auto;"
                        />
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" id="registerForm">
                                <div class="form-group">
                                    <input type="text" 
                                        class="form-control 
                                        form-control-user" 
                                        id="name"
                                        placeholder="Name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <input type="email" 
                                        class="form-control 
                                        form-control-user" 
                                        id="email"
                                        placeholder="Email Address"
                                        required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" 
                                            class="form-control 
                                            form-control-user"
                                            id="password" 
                                            placeholder="Password"
                                            required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" 
                                            class="form-control 
                                            form-control-user"
                                            id="repeatpassword" 
                                            placeholder="Repeat Password"
                                            required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <script>

    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    {{-- koneksi api --}}
    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordrepeat = document.getElementById('repeatpassword').value;

            if (password !== passwordrepeat) {
                alert('Password anda tidak sama');
                return;
            }

            try {
                const response = await fetch('http://localhost:8000/api/register', {
                    method : 'POST',
                    headers : {
                        'Content-Type' : 'application/json',
                        'Accept' : 'application/json'
                    },
                    body : JSON.stringify({ name, email, password})
                })
                const data = await response.json();

                if (response.ok) {
                    alert('Register berhasil');

                    window.location.href = '/login';
                } else {
                    alert(data.message || 'Registrasi gagal');
                }

            } catch (error) {
                console.error(error);
            }
            
        })
    </script>

</body>
</html>