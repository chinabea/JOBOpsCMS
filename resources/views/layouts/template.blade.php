<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JObOps CMS</title>
    <link rel="icon" type="image/png" href="{{ asset('dist/img/MICT-Logo.png') }}">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('cdn/jquery-3.5.1.min.js') }}"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('cdn/toastr.min.css') }}">
    <script src="{{ asset('cdn/toastr.min.js') }}"></script>



    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/simplemde/simplemde.min.css') }}">
    <!-- DO NOT REMOVE THIS  -->
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/tinymce/skins/ui/oxide/skin.min.css') }}">
    <!-- Bootstrap Select CSS -->
    <link href="{{ asset('cdn/bootstrap-select@1.13.18.min.css') }}" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="{{ asset('cdn/bootstrap@4.5.2.min.js') }}"></script>
    <!-- Bootstrap Select JS -->
    <script src="{{ asset('cdn/bootstrap-select@1.13.18-select.min.js') }}"></script>
    
    <!-- CodeMirror -->
    <link rel="stylesheet" href="../../plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="../../plugins/codemirror/theme/monokai.css">

</head> @php $theme = false; @endphp

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper"> @include('layouts.topnav') @include('layouts.sidebar') @yield('content') @include('layouts.footer') 
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- FLOT CHARTS -->
        <script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="{{ asset('plugins/flot/plugins/jquery.flot.resize.js') }}"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="{{ asset('plugins/flot/plugins/jquery.flot.pie.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        

        <!-- DataTables  & Plugins -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('datatables.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <!-- CodeMirror -->
        <script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>
        <script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
        <script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
        <script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
        
        <!-- Custom Js -->
        <script src="{{ asset('js/custom.js') }}"></script>
        
        <script>
        function confirmDelete(url) {
            if (confirm('Are you sure you want to delete this record?')) {
                // Create a hidden form and submit it programmatically
                var form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = '@csrf @method('delete')';
                document.body.appendChild(form);
                form.submit();
            }
        }
        </script>

        @if(session('success'))
            <script>
                toastr.success('{{ session('success') }}');
            </script>
        @elseif(session('delete'))
            <script>
                toastr.delete('{{ session('delete') }}');
            </script>
        @elseif(session('message'))
            <script>
                toastr.message('{{ session('message') }}');
            </script>
        @elseif(session('error'))
            <script>
                toastr.error('{{ session('error') }}');
            </script>
        @endif


</body>
</html>