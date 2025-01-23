<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sub Admin Dashboard')</title>
    <!--custom CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Sidebar Styling */
        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: white;
            margin-left: -250px;
            transition: margin 0.25s ease-in-out;
        }

        #wrapper {
            display: flex;
            flex-wrap: nowrap;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            flex: 1;
            width: 100%;
            padding: 20px;
        }

        .profile-header {
            margin-top: 30px;
            text-align: center;
        }

        .profile-header .profile-photo img {
            border: 3px solid #ddd;
            padding: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-header h2 {
            font-weight: bold;
            margin-top: 15px;
        }

        .profile-header p {
            color: #6c757d;
            font-size: 16px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }

        .btn-outline-danger {
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 10px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .sidebar-heading {
            text-align: center;
            font-size: 1.5rem;
            padding: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .list-group-item {
            background-color: #343a40;
            color: white;
            border: none;
        }

        .list-group-item:hover {
            background-color: #495057;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @include('layout.sub_admin.sidebar')

        <!-- Main Content -->
        <div id="page-content-wrapper">
            <!-- Navbar -->
            @include('layout.sub_admin.navbar')

            <!-- Page Content -->
            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar Functionality
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    </script>
</body>

</html>