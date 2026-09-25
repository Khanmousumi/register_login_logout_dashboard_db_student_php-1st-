<?php

session_start();

// Login করা না থাকলে Login page-এ পাঠাবে
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
include "../DB.php";

$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
$phone = $_SESSION['phonenumber'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}


body {
    background: #f5f7fb;
    color: #1e293b;
}


a {
    text-decoration: none;
}


/* ================= DASHBOARD ================= */

.dashboard {
    min-height: 100vh;
}


/* ================= SIDEBAR ================= */

.sidebar {
    width: 240px;
    height: 100vh;
    background: #111827;
    position: fixed;
    left: 0;
    top: 0;
    padding: 25px 15px;
    color: white;
    z-index: 1000;
}


.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 21px;
    font-weight: bold;
    padding: 0 12px 30px;
}


.logo i {
    color: #60a5fa;
    font-size: 27px;
}


.logo span span {
    color: #60a5fa;
}


/* MENU */

.menu {
    list-style: none;
}


.menu li {
    margin-bottom: 7px;
}


.menu li a {
    display: flex;
    align-items: center;
    gap: 14px;
    color: #cbd5e1;
    padding: 12px 13px;
    border-radius: 8px;
    transition: 0.3s;
}


.menu li a:hover,
.menu li.active a {
    background: #2563eb;
    color: white;
}


.menu li a i {
    width: 20px;
}


/* LOGOUT */

.logout {
    position: absolute;
    bottom: 25px;
    left: 15px;
    right: 15px;
}


.logout a {
    display: flex;
    gap: 14px;
    align-items: center;
    color: #cbd5e1;
    padding: 12px 13px;
    border-radius: 8px;
}


.logout a:hover {
    background: #dc2626;
    color: white;
}


/* ================= MAIN ================= */

.main {
    margin-left: 240px;
}


/* ================= TOPBAR ================= */

.topbar {
    height: 75px;
    background: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 28px;
    border-bottom: 1px solid #e5e7eb;
}


.top-left {
    display: flex;
    align-items: center;
    gap: 12px;
}


.top-left h2 {
    font-size: 22px;
}


.top-left p {
    color: #64748b;
    font-size: 12px;
    margin-top: 3px;
}


.menu-btn {
    display: none;
    border: none;
    background: #eff6ff;
    color: #2563eb;
    width: 38px;
    height: 38px;
    border-radius: 8px;
    cursor: pointer;
}


/* TOP RIGHT */

.top-right {
    display: flex;
    align-items: center;
    gap: 20px;
}


.notification {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: #f1f5f9;
    cursor: pointer;
    position: relative;
    font-size: 17px;
}


.notification span {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 17px;
    height: 17px;
    background: #ef4444;
    color: white;
    font-size: 10px;
    border-radius: 50%;
}


.profile {
    display: flex;
    align-items: center;
    gap: 9px;
}


.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #2563eb;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}


.profile-text {
    display: flex;
    flex-direction: column;
}


.profile-text strong {
    font-size: 13px;
}


.profile-text small {
    color: #64748b;
    font-size: 11px;
    margin-top: 2px;
}


/* ================= CONTENT ================= */

.content {
    padding: 25px;
}


/* ================= CARDS ================= */

.cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 20px;
}


.card {
    background: white;
    padding: 18px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    transition: 0.3s;
}


.card:hover {
    transform: translateY(-3px);
}


.card-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
}


.blue {
    background: #dbeafe;
    color: #2563eb;
}


.green {
    background: #dcfce7;
    color: #16a34a;
}


.orange {
    background: #ffedd5;
    color: #ea580c;
}


.purple {
    background: #f3e8ff;
    color: #9333ea;
}


.card p {
    color: #64748b;
    font-size: 12px;
    margin-bottom: 4px;
}


.card h2 {
    font-size: 21px;
}


.card small {
    color: #16a34a;
    font-size: 10px;
}


/* ================= PANEL ================= */

.panel,
.quick-panel {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    margin-bottom: 20px;
}


.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}


.panel-header h3 {
    font-size: 17px;
}


.panel-header p {
    color: #94a3b8;
    font-size: 11px;
    margin-top: 3px;
}


.view-btn {
    background: #eff6ff;
    color: #2563eb;
    padding: 7px 11px;
    border-radius: 6px;
    font-size: 11px;
}


/* ================= TABLE ================= */

.table-container {
    overflow-x: auto;
}


table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}


th {
    text-align: left;
    color: #64748b;
    font-size: 11px;
    padding: 10px;
    border-bottom: 1px solid #e5e7eb;
}


td {
    padding: 12px 10px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 12px;
}


.student {
    display: flex;
    align-items: center;
    gap: 9px;
}


.student-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #dbeafe;
    color: #2563eb;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}


.status {
    background: #dcfce7;
    color: #15803d;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 10px;
}


/* ================= QUICK ACTION ================= */

.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}


.quick-actions a {
    background: #f8fafc;
    padding: 15px;
    border-radius: 9px;
    text-align: center;
    color: #475569;
    transition: 0.3s;
}


.quick-actions a:hover {
    background: #eff6ff;
    color: #2563eb;
}


.quick-actions i {
    display: block;
    color: #2563eb;
    font-size: 20px;
    margin-bottom: 7px;
}


.quick-actions span {
    font-size: 11px;
}


/* ================= RESPONSIVE ================= */

@media (max-width: 1000px) {

    .cards {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 768px) {

    .sidebar {
        left: -240px;
        transition: 0.3s;
    }


    .sidebar.show {
        left: 0;
    }


    .main {
        margin-left: 0;
    }


    .menu-btn {
        display: block;
    }


    .profile-text {
        display: none;
    }


    .content {
        padding: 18px;
    }


    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 500px) {

    .cards {
        grid-template-columns: 1fr;
    }


    .topbar {
        padding: 0 15px;
    }


    .content {
        padding: 12px;
    }


    .top-left h2 {
        font-size: 19px;
    }


    .top-left p {
        display: none;
    }

}


    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="dashboard">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar" id="sidebar">

        <div class="logo">

            <i class="fa-solid fa-graduation-cap"></i>

            <span>Student<span>MS</span></span>

        </div>


        <ul class="menu">

            <li class="active">

                <a href="#">

                    <i class="fa-solid fa-house"></i>

                    <span>Dashboard</span>

                </a>

            </li>


            <li>

                <a href="student.php">

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


            <li>

                <a href="#">

                    <i class="fa-solid fa-chart-line"></i>

                    <span>Reports</span>

                </a>

            </li>


            <li>

                <a href="#">

                    <i class="fa-solid fa-gear"></i>

                    <span>Settings</span>

                </a>

            </li>

        </ul>


        <!-- Logout -->

        <div class="logout">

            <a href="../login/logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </a>

        </div>

    </aside>


    <!-- ================= MAIN ================= -->

    <main class="main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="top-left">

                <button class="menu-btn" id="menuBtn">

                    <i class="fa-solid fa-bars"></i>

                </button>


                <div>

                    <h2>Dashboard</h2>

                    <p>Welcome back, <?php echo htmlspecialchars($fullname); ?> 👋</p>

                </div>

            </div>


            <div class="top-right">

                <button class="notification">

                    <i class="fa-regular fa-bell"></i>

                    <span>3</span>

                </button>


                <div class="profile">

                    <div class="avatar">

                        <?php echo strtoupper(substr($fullname, 0, 1)); ?>

                    </div>


                    <div class="profile-text">

                        <strong>
                            <?php echo htmlspecialchars($fullname); ?>
                        </strong>

                        <small>Administrator</small>

                    </div>

                </div>

            </div>

        </header>


        <!-- ================= CONTENT ================= -->

        <section class="content">


            <!-- STATISTICS -->

            <div class="cards">


                <div class="card">

                    <div class="card-icon blue">

                        <i class="fa-solid fa-user-graduate"></i>

                    </div>

                    <div>

                        <p>Total Students</p>

                        <h2>1,250</h2>

                        <small>+12% this month</small>

                    </div>

                </div>


                <div class="card">

                    <div class="card-icon green">

                        <i class="fa-solid fa-chalkboard-user"></i>

                    </div>

                    <div>

                        <p>Total Teachers</p>

                        <h2>85</h2>

                        <small>+5 new teachers</small>

                    </div>

                </div>


                <div class="card">

                    <div class="card-icon orange">

                        <i class="fa-solid fa-book"></i>

                    </div>

                    <div>

                        <p>Total Courses</p>

                        <h2>32</h2>

                        <small>4 new courses</small>

                    </div>

                </div>


                <div class="card">

                    <div class="card-icon purple">

                        <i class="fa-solid fa-money-bill-wave"></i>

                    </div>

                    <div>

                        <p>Total Revenue</p>

                        <h2>৳85,500</h2>

                        <small>+18% this month</small>

                    </div>

                </div>

            </div>


            <!-- ================= RECENT STUDENTS ================= -->

            <div class="panel">

                <div class="panel-header">

                    <div>

                        <h3>Recent Students</h3>

                        <p>Latest registered students</p>

                    </div>

                    <a href="#" class="view-btn">
                        View All
                    </a>

                </div>


                <div class="table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>Student</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            <tr>

                                <td>

                                    <div class="student">

                                        <div class="student-avatar">
                                            <?php echo strtoupper(substr($fullname, 0, 1)); ?>
                                        </div>

                                        <span>
                                            <?php echo htmlspecialchars($fullname); ?>
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    <?php echo htmlspecialchars($email); ?>
                                </td>


                                <td>
                                    <?php echo htmlspecialchars($phone); ?>
                                </td>


                                <td>

                                    <span class="status">
                                        Active
                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- ================= QUICK ACTIONS ================= -->

            <div class="quick-panel">

                <div class="panel-header">

                    <div>

                        <h3>Quick Actions</h3>

                        <p>Manage your system</p>

                    </div>

                </div>


                <div class="quick-actions">

                    <a href="#">

                        <i class="fa-solid fa-user-plus"></i>

                        <span>Add Student</span>

                    </a>


                    <a href="#">

                        <i class="fa-solid fa-user-tie"></i>

                        <span>Add Teacher</span>

                    </a>


                    <a href="#">

                        <i class="fa-solid fa-book-medical"></i>

                        <span>Add Course</span>

                    </a>


                    <a href="#">

                        <i class="fa-solid fa-file-invoice-dollar"></i>

                        <span>Payment</span>

                    </a>

                </div>

            </div>

        </section>

    </main>

</div>


<!-- ================= JAVASCRIPT ================= -->

<script>

const menuBtn = document.getElementById("menuBtn");

const sidebar = document.getElementById("sidebar");

menuBtn.addEventListener("click", function () {

    sidebar.classList.toggle("show");

});

</script>

</body>

</html>