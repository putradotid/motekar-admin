<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Motekar</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/font.css') }}">
</head>

<body class="bg-gray-50 text-gray-900 font-[Inter]">
  
<!-- Navbar -->
@include('components.public.topbar')

<!-- Begin Page Content -->
@yield('content')
<!-- /.container-fluid -->

<!-- Footer -->
@include('components.public.footer')
<!-- End of Footer -->
</body>
</html>