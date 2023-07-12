@extends('layout.admin')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if(Session::has('successMsg'))
    <script>
        swal("Thông báo", "{{Session::get('successMsg')}}", "success");
    </script>
  @endif

  @if(Session::has('errorMsg'))
    <script>
        swal("Thất bại", "{{Session::get('errorMsg')}}", "warning");
    </script>
  @endif
