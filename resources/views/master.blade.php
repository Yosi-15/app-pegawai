<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App Pegawai')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header { background: #333; color: white; padding: 1rem; }
        nav ul { list-style: none; padding: 0; display: flex; gap: 1rem; }
        nav a { color: white; text-decoration: none; }
        main { padding: 2rem; }
        footer { background: #333; color: white; text-align: center; padding: 1rem; margin-top: 2rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <header>
        <h1>@yield('page-title', 'App Pegawai')</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/employees') }}">Employee</a></li>
                <li><a href="{{ url('/departments') }}">Department</a></li>
                <li><a href="{{ url('/attendance') }}">Attendance</a></li>
                <li><a href="{{ url('/report') }}">Report</a></li>
                <li><a href="{{ url('/settings') }}">Settings</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} App Pegawai</p>
    </footer>
</body>
</html>