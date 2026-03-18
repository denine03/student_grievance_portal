<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Grievance Portal</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background: #34495e;
            padding: 12px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #1abc9c;
        }

        .container {
            text-align: center;
            padding: 60px 20px;
        }

        .btn {
            display: inline-block;
            background: #1abc9c;
            color: white;
            padding: 12px 25px;
            margin: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #16a085;
        }

        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Student Grievance Portal</h1>
    <p>Raise your concerns easily and track them online</p>
</header>

<nav>
    <a href="/">Home</a>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
    <a href="/grievance">Submit Grievance</a>
</nav>

<div class="container">
    <h2>Welcome to the Portal</h2>
    <p>
        This platform allows students to submit complaints regarding academics,
        facilities, or administration and track their status.
    </p>


    <a href="/login" class="btn">Login</a>
    <a href="/register" class="btn">Register</a>
</div>

<footer>
    <p>&copy; {{ date('Y') }} Student Grievance Portal</p>
</footer>

</body>
</html>