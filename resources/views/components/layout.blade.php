<link rel="stylesheet" href="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.css') }}">
<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

@include("layouts.app-title")
<body>
   
@include("layouts.app-sidebar")
@include("layouts.app-header")
<!--start page wrapper -->
  {{ $slot }}
<!--end page wrapper -->
@include("layouts.app-footer")