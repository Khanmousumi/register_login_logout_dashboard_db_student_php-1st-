
<?php
$conn=mysqli_connect("localhost","root","","admin_system");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
   $query= mysqli_query($conn,"INSERT INTO `users`( `fullname`, `email`, `phonenumber`, `password`) VALUES ('$fullname','$email','$phonenumber','$password')");


    if ($query) {

        echo "<script>
                alert('Successfully Submitted');
                window.location.href='../login/login.php';
              </script>";

    } else {

        echo "Database Error: " . mysqli_error($conn);
    }

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Responsive Login Form</title>

    <style>
        /* Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background: linear-gradient(135deg, #667eea, #764ba2);

            padding: 20px;
        }

        /* Login Box */
        .login-box {
            width: 100%;
            max-width: 420px;

            background: #ffffff;
            padding: 40px;

            border-radius: 20px;

            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        /* Heading */
        .login-box h1 {
            text-align: center;
            color: #333;
            font-size: 30px;
            margin-bottom: 8px;
        }

        /* Subtitle */
        .subtitle {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Input Group */
        .input-box {
            margin-bottom: 20px;
        }

        .input-box label {
            display: block;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-box input {
            width: 100%;
            padding: 13px 15px;

            border: 1px solid #ddd;
            border-radius: 10px;

            outline: none;
            font-size: 14px;

            transition: 0.3s;
        }

        /* Input Focus */
        .input-box input:focus {
            border-color: #667eea;

            box-shadow:
                0 0 0 3px rgba(102, 126, 234, 0.15);
        }

        /* Options */
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;

            font-size: 13px;
            margin-bottom: 25px;
        }

        .options label {
            color: #555;
        }

        .options input {
            margin-right: 5px;
        }

        .options a {
            color: #667eea;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        /* Login Button */
        button {
            width: 100%;
            padding: 13px;

            border: none;
            border-radius: 10px;

            background: linear-gradient(135deg, #667eea, #764ba2);

            color: white;
            font-size: 16px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(102, 126, 234, 0.35);
        }

        /* Register */
        .register {
            text-align: center;

            margin-top: 25px;

            font-size: 14px;
            color: #666;
        }

        .register a {
            color: #667eea;
            font-weight: 600;

            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {

            body {
                padding: 15px;
            }

            .login-box {
                padding: 30px 20px;
                border-radius: 15px;
            }

            .login-box h1 {
                font-size: 25px;
            }

            .options {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="login-box">

        <h1>Welcome Back!</h1>

        <p class="subtitle">
            Please login to your account
        </p>

        <form method="POST" >

        <div class="input-box">
                <label>Fullname</label>

                <input
                    type="text" name="fullname"
                    placeholder="Enter your fullname"
                    required
                >
            </div>



            <!-- Email -->
            <div class="input-box">
                <label>Email</label>

                <input
                    type="text" name="email"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="input-box">
                <label>Phonenumber</label>

                <input
                    type="tel" name="phonenumber"
                    placeholder="Enter your phonenumber"
                    required
                >
            </div>

            <!-- Password -->
            <div class="input-box">
                <label>Password</label>

                <input
                    type="password" name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <!-- Remember & Forgot -->
            <div class="options">

                <label>
                    <input type="checkbox">
                    Remember me
                </label>

                <a href="#">
                    Forgot Password?
                </a>

            </div>

            <!-- Login Button -->
            <button type="submit" name="register" >
                register
            </button>

            <!-- Register -->
            <p class="register">
                Don't have an account?
                <a href="../login/login.php">
                    login
                </a>
            </p>

        </form>

    </div>

</body>
</html>

