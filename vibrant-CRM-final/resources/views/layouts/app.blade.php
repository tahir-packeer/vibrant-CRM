<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vibrant') }}</title>

    <link rel="icon" href="{{ asset('images/logo1.png') }}" style="border-radius: 10px" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1e1e1e; /* Dark background for the entire page */
            color: #ffffff; /* White text color for readability */
            margin: 0;
            padding: 0;
        }

        .bg-gradient-primary {
            background: linear-gradient(180deg, #000000, #333333); /* Black gradient background */
        }

        .sidebar {
            background-color: #2C2C2C; /* Dark grey sidebar */
            min-height: 100vh;
            padding: 0;
            transition: width 0.3s;
        }

        .sidebar .nav-link {
            padding: 15px 25px;
            font-size: 1.1rem;
            color: #ffffff; /* White text for sidebar links */
            transition: background 0.3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1); /* Slight background color on hover */
        }

        .sidebar .nav-link.active {
            background-color: #2C2C2C; /* Darker active link */
        }

        .content-wrapper {
            display: flex;
            flex-direction: row;
            height: 100vh;
            overflow-x: hidden;
        }

        .main-content {
            width: 100%;
            padding: 30px;
            background-color: #1e1e1e;
            overflow-y: auto;
        }

        .card {
            background-color: #2C2C2C; /* Dark card background */
            border: none;
            color: white;
            border-radius: 10px;
            transition: transform 0.2s ease-in-out, box-shadow 0.3s ease-in-out;
        }



        .card-header, .card-footer {
            background-color: #2C2C2C; /* Darker color for header and footer */
            border-radius: 10px 10px 0 0; /* Rounded top corners */
            color: #ffffff;
            padding: 15px;
        }

        .card-body {
            background-color: #2C2C2C;
            padding: 20px;
            border-radius: 0 0 10px 10px; /* Rounded bottom corners */
        }

        h5, .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #dd9c32;
            border: none;
        }

        .btn-primary:hover {
            background-color: #f89d18;
        }

        /* Table styling */
        table.table-dark {
            background: #2C2C2C; /* Black gradient for the table */
            color: #ffffff; /* White text for table */
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
        }

        table.table-dark th, table.table-dark td {
            border-color: #2C2C2C; /* Border for table cells */
            padding: 15px;
            vertical-align: middle;
        }

        table.table-dark th {
            background-color: #2C2C2C; /* Darker header background */
        }
        table.table-dark td {
            background-color: #2C2C2C; /* Darker cell background */

        }

        table.table-dark td img {  /* Image styling */
            border-radius: 15px;
        }

        .btn-warning, .btn-danger {
            font-weight: 600;
            color: white;
        }

        .btn-warning {
            background-color: #fcb045;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e69523;
        }

        .btn-danger {
            background-color: #ca1822;
            border: none;
        }

        .btn-danger:hover {
            background-color: #9c242f;
        }

        .container-fluid {
            color: #dd9c32;
        }

    </style>
</head>
<body>
<div id="app">
    <div class="content-wrapper">
        <!-- Sidebar Section -->
        @if(!request()->routeIs('login') && !request()->routeIs('register') && Auth::check())
            @include('layouts.sidebar')
        @endif

        <!-- Main Content Section -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
