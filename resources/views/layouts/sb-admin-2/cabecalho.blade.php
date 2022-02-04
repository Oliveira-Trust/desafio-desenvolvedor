<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.sb-admin-2.favicon')
    <title>Oliveira Trust</title>
    
    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="{{asset('sb-admin-2-assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="{{asset('sb-admin-2-assets/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('sb-admin-2-assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/oliveira.css')}}" rel="stylesheet">
    <!-- Jquery -->
    <script src="{{asset('sb-admin-2-assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/oliveira.js')}}"></script>

</head>