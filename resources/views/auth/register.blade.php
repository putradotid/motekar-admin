<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

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
                            <form class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="role" id="role">

                                    <div class="dropdown w-100">
                                        <button class="btn btn-light dropdown-toggle w-100 text-left"
                                            type="button"
                                            id="dropdownRole"
                                            data-toggle="dropdown"
                                            aria-expanded="false">
                                            Select Role
                                        </button>

                                        <div class="dropdown-menu w-100">
                                            <a class="dropdown-item" href="#" onclick="selectRole('admin', 'Admin')">Admin</a>
                                            <a class="dropdown-item" href="#" onclick="selectRole('user', 'User')">User</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a>
                            </form>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
    function selectRole(value, text) {
        document.getElementById('role').value = value;
        document.getElementById('dropdownRole').innerText = text;
    }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

</body>
</html>