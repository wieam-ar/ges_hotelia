<?php
session_start();

include './includes/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && $password === $admin['password']) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <style>
        /* Admin Login Form Styling */
        body {
            font-family: Arial, sans-serif;
            background: #d8d4ce !important;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            max-width: 400px;
            width: 100%;
            padding: 40px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 700;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
           
            border-radius: 2px;
        }

        /* Error message styling */
        p[style*="color:red"] {
            background-color: #ffebee;
            border: 1px solid #ffcdd2;
            color: #d32f2f !important;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 14px;
            text-align: center;
            position: relative;
        }

        p[style*="color:red"]::before {
            content: '⚠';
            margin-right: 8px;
            font-weight: bold;
        }

        /* Input field styling */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            background-color: #f8f9fa;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color:rgb(121, 110, 110);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #6c757d;
            font-size: 15px;
        }

        /* Button styling */
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background: #333 ;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(78, 79, 80, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        button[type="submit"]:hover::before {
            left: 100%;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            form {
                margin: 20px;
                padding: 30px 25px;
            }

            h2 {
                font-size: 24px;
            }

            input[type="text"],
            input[type="password"],
            button[type="submit"] {
                font-size: 14px;
                padding: 12px 15px;
            }
        }

        /* Additional security styling */
        .admin-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>


</head>

<body>


    <form method="post">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>