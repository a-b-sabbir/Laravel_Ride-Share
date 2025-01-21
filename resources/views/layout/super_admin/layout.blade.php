<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Sidebar Styling */

        .profile-header {
            background: linear-gradient(to right, #007bff, #6610f2);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
        }

        .profile-header h2 {
            font-weight: bold;
        }

        .profile-header p {
            font-size: 16px;
        }

        .btn-custom {
            background-color: #6610f2;
            color: white;
        }

        .btn-custom:hover {
            background-color: #4a0cb5;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

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
    @yield('content')
</body>

</html>