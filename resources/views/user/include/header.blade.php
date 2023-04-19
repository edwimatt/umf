<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! env('APP_URL') !!}assets/img/logo.png" type="image/gif" sizes="16x16">
    <title>Understanding My Facility</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.lineProgressbar.css')}}"> --}}
    <link rel="stylesheet"
        href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="{{ asset('assets/css/user-stylesheet/user-custom.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/user-stylesheet/user-style.css') }}"> --}}
    <link rel="shortcut icon" href="{!! env('APP_URL') !!}uploads/2020-02/1fdccedcd2b0d3caf293eb0c0a221a36.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery.lineProgressbar.js')}}"></script> --}}

    <!-- jQuery -->
</head>
<script type="text/javascript">
    var client_url = "{!! env('APP_URL') !!}";
    let base_url = '{{ URL::to('/') }}';
    var currentUser = JSON.parse('{!! Session::get('user') !!}');
    var node_chat_url = '{{ env('NODE_CHAT_URL') }}';
</script>

<body class="nav-sm">
    <div class="container body">
        @include('user.include.nav')
        <div class="main_container">
            <div class="row nomargin">
