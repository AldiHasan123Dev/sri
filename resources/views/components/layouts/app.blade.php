<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #117816;
            color: white;
            transition: all 0.3s;
        }

        .sidebar h4 {
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 1rem;
        }

        .sidebar .nav-link {
            color: white;
            transition: background-color 0.2s, padding-left 0.2s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 20px;
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
            font-weight: bold;
        }

        .navbar-custom {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        main {
            background-color: #f1f3f5;
            min-height: calc(100vh - 56px);
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar text-white d-flex flex-column p-4" style="width: 250px; min-height: 100vh;">
        <h4 class="mb-4 border-bottom pb-2">My Dashboard</h4>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-2 dotted-border">
                <a href="/admin/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active bg-white text-primary' : 'text-white' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2 dotted-border">
                <a href="/berita" class="nav-link {{ request()->is('orders') ? 'active bg-white text-primary' : 'text-white' }}">
                    <i class="bi bi-newspaper me-2"></i> Berita
                </a>
            </li>
            <li class="nav-item mb-2 dotted-border">
                <a href="/admin/pengurus" class="nav-link {{ request()->is('customers') ? 'active bg-white text-primary' : 'text-white' }}">
                    <i class="bi bi-people-fill me-2"></i> Pengurus
                </a>
            </li>
        </ul>             
    </nav>    

    <!-- Content -->
    <div class="flex-grow-1 d-flex flex-column">
        <!-- Navbar -->
        <header class="navbar navbar-custom px-4 py-2 shadow-sm">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <span class="navbar-brand h1 mb-0">Dashboard</span>
    
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Admin" alt="Profile" width="32" height="32" class="rounded-circle me-2">
                        <span class="text-secondary">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="/profile">Ganti Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
    
        <!-- Page Content -->
        <main class="p-4">
            @yield('content')
        </main>
    </div>    

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
