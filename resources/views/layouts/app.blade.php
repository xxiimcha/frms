<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | RHC-HRMS</title>

  <!-- Google Font: Source Sans Pro -->
  @include('partial.head')
</head>
<body class="hold-transition login-page">
  @yield('content')

  <!-- Footer Scripts -->
  @include('partial.foot')
</body>
</html>
