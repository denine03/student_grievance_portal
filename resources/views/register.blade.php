<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
        }

        .form-box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            background: #1abc9c;
            color: white;
            padding: 12px;
            border: none;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background: #16a085;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            text-decoration: none;
            color: #1abc9c;
        }

        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>

<body>

<header>
    <h1>Student Grievance Portal</h1>
    <p>Create your account to raise complaints</p>
</header>

<div class="container">
    <div class="form-box">
        <h2>Register</h2>

        <form action="/register" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="student_id" placeholder="Student ID" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button type="submit" class="btn">Register</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="/login">Login</a></p>
        </div>
    </div>
</div>

<footer>
    <p>© 2026 Mizoram University | Email: support@mzu.edu.in</p>
</footer>

</body>
</html>