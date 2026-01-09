<?php include("../config/config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Statemate - Users</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../icons/logo.jpg" rel="icon">
    <link href="../icons/logo.jpg" rel="IAP">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../lib/sweetalert/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <?php include("createUser.php"); ?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard.php" class="logo d-flex align-items-center">
                <img src="../icons/logo.jpg" alt="">
                <span class="d-none d-lg-block">Statemate</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
    </header>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="dashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="posts.php" class="nav-link collapsed">
                    <i class="bi bi-chat"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link collapsed">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a href="" class="nav-link collapsed" data-bs-toggle="modal" data-bs-target="#logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log out</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar-->

    <div
        class="modal p-4 py-md-5 fade"
        tabindex="-1"
        role="dialog"
        id="logout">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0 fw-semibold">Log out your account?</h5>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button
                        type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end">
                        <a href="../config/config.php?logout=true" class="text-decoration-none"><strong>Logout</strong></a>
                    </button>
                    <button
                        type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <main id="main" class="main">
        <div class="pagetitle">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>Users</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </nav>
                </div>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createUser">Create User</button>
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="table-responsive" style="height: 80%; min-height: 75vh">
                <table class="table table-borderless datatables" id="myTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Branch</th>
                            <th>Department</th>
                            <th>Profile</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $users = $conn->prepare("SELECT id, name, branch, dept, profile, created, modified FROM users WHERE name != :name");
                        $users->bindParam(":name", $name);
                        $users->execute();

                        $getUsers = $users->fetchAll(PDO::FETCH_OBJ);

                        if ($getUsers) {
                            foreach ($getUsers as $user) {
                                $id = $user->id;
                                $username = $user->name;
                                $branch = $user->branch;
                                $dept = $user->dept;
                                $prof = $user->profile;
                                $created = $user->created;
                                $modified = $user->modified;

                                $created = date("M. d, Y", strtotime($created));
                                $modified = date("M. d, Y", strtotime($modified));

                                echo '<tr>
                                    <td>' . $username . '</td>
                                    <td>' . $branch . '</td>
                                    <td>' . $dept . '</td>
                                    <td>' . $prof . '</td>
                                    <td>' . $created . '</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Options</button>
                                            <div class="dropdown-menu">
                                                <li><a href="#" class="dropdown-item">Disable</a></li>
                                                <li><a href="#" class="dropdown-item">Update</a></li>
                                                <li><a href="#" class="dropdown-item">Reset Password</a></li>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo '<tr>
                                <td colspan="5" class="text-center">No data found.</td>
                            </tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include("../layout/footer.php") ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../lib/jquery/jquery-3.7.1.min.js"></script>
    <script src="../lib/sweetalert/dist/sweetalert2.all.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="js/addUser.js"></script>

</body>

</html>