<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

include "../db.php";

// সব student দেখাবে
$sql = "SELECT id, fullname, email, phonenumber FROM users ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Students</title>

 

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        .students-page {
            padding: 25px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h2 {
            font-size: 24px;
        }

        .page-header p {
            color: #64748b;
            font-size: 13px;
            margin-top: 5px;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        .student-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            max-width: 350px;
            padding: 11px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #2563eb;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            text-align: left;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            padding: 13px;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        .student-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .status {
            background: #dcfce7;
            color: #15803d;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 10px;
        }

        .edit-btn {
            background: #eff6ff;
            color: #2563eb;
            padding: 7px 9px;
            border-radius: 6px;
            margin-right: 5px;
        }

        .delete-btn {
            background: #fee2e2;
            color: #dc2626;
            padding: 7px 9px;
            border-radius: 6px;
        }

        @media(max-width: 600px) {

            .students-page {
                padding: 15px;
            }

            .page-header {
                align-items: flex-start;
                gap: 10px;
            }

            .page-header h2 {
                font-size: 20px;
            }

            .add-btn {
                padding: 8px 10px;
                font-size: 11px;
            }

        }

    </style>

</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">

            <i class="fa-solid fa-graduation-cap"></i>

            <span>Student<span>MS</span></span>

        </div>


        <ul class="menu">

            <li>
                <a href="dashboard.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="active">
                <a href="students.php">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Students</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Teachers</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-book"></i>
                    <span>Courses</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-money-bill"></i>
                    <span>Payments</span>
                </a>
            </li>

        </ul>


        <div class="logout">

            <a href="../login/logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </a>

        </div>

    </aside>


    <!-- MAIN -->

    <main class="main">

        <header class="topbar">

            <div class="top-left">

                <button class="menu-btn">

                    <i class="fa-solid fa-bars"></i>

                </button>

                <div>

                    <h2>Students</h2>

                    <p>Manage all students</p>

                </div>

            </div>


            <div class="top-right">

                <div class="profile">

                    <div class="avatar">

                        <?php
                        echo strtoupper(
                            substr($_SESSION['fullname'], 0, 1)
                        );
                        ?>

                    </div>

                    <div class="profile-text">

                        <strong>
                            <?php
                            echo htmlspecialchars($_SESSION['fullname']);
                            ?>
                        </strong>

                        <small>Administrator</small>

                    </div>

                </div>

            </div>

        </header>


        <!-- STUDENTS -->

        <section class="students-page">

            <div class="page-header">

                <div>

                    <h2>All Students</h2>

                    <p>Registered students list</p>

                </div>


                <a href="../register/register.php" class="add-btn">

                    <i class="fa-solid fa-plus"></i>

                    Add Student

                </a>

            </div>


            <div class="student-box">

                <div class="search-box">

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search student..."
                    >

                </div>


                <div class="table-container">

                    <table id="studentTable">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Student</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                        <?php

                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                            <tr>

                                <td>
                                    <?php echo $row['id']; ?>
                                </td>


                                <td>

                                    <div class="student-name">

                                        <div class="student-avatar">

                                            <?php
                                            echo strtoupper(
                                                substr($row['fullname'], 0, 1)
                                            );
                                            ?>

                                        </div>

                                        <?php
                                        echo htmlspecialchars($row['fullname']);
                                        ?>

                                    </div>

                                </td>


                                <td>
                                    <?php
                                    echo htmlspecialchars($row['email']);
                                    ?>
                                </td>


                                <td>
                                    <?php
                                    echo htmlspecialchars($row['phonenumber']);
                                    ?>
                                </td>


                                <td>

                                    <span class="status">
                                        Active
                                    </span>

                                </td>


                                <td>

                                    <a href="#" class="edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="#" class="delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>

                                </td>

                            </tr>

                        <?php

                            }

                        } else {

                        ?>

                            <tr>

                                <td colspan="6" style="text-align:center;">
                                    No students found
                                </td>

                            </tr>

                        <?php

                        }

                        ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </main>

</div>


<script>

const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function () {

    let searchValue = this.value.toLowerCase();

    let rows = document.querySelectorAll("#studentTable tbody tr");

    rows.forEach(function (row) {

        let text = row.innerText.toLowerCase();

        row.style.display =
            text.includes(searchValue) ? "" : "none";

    });

});

</script>

</body>

</html>