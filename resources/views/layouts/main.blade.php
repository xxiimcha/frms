<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RHC HRMS | @yield('title')</title>

  @include('partial.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('partial.header')

  <!-- Sidebar -->
  @include('partial.sidebar')

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('header')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @yield('breadcrumb')
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      @yield('content')
    </section>
  </div>

  <!-- Footer -->
  @include('partial.footer')
</div>

@include('partial.foot')

@yield('scripts')
</body>
</html>
