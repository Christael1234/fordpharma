
@include('includes.admin.head')
@include('includes.admin.header')
@include('includes.admin.sidebar')

<div class="content-wrapper">
<main id="main" class="main">
@yield('content')
  <!-- /.content -->
  </div>
</main>
@include('includes.admin.footer')
@include('includes.admin.script')