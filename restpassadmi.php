<?php
session_start();
include './includes/db.php';


if (isset($_POST['change'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $stmt = $pdo->prepare("UPDATE admin SET password = :password WHERE username = :username");
        $stmt->execute([
            'password' => $new_password,
            'username' => $_SESSION['admin']
        ]);
        $success = "Password changed successfully.";
    } else {
        $error = "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <style>
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


        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
        }

        /* Message styling */
        p {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        /* Error message */
        p[style*="color:red"] {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33 !important;
        }

        /* Success message */
        p[style*="color:green"] {
            background-color: #efe;
            border: 1px solid #cfc;
            color: #363 !important;
        }

        /* Input field styling */
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        input[type="password"]::placeholder {
            color: #999;
            font-size: 14px;
        }

        /* Button styling */
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background: #333;
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
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            input[type="password"],
            button[type="submit"] {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>

</body>

</html>
<!-- HTML Form -->
<form method="post">
    <h2>Change Password</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <input type="password" name="new_password" placeholder="New Password" required><br><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>
    <button type="submit" name="change">Change Password</button>
</form>