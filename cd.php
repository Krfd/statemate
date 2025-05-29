<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Customer Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="icons/logo.jpg" rel="icon">
  <link href="icons/logo.jpg" rel="IAP">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.html" class="logo d-flex align-items-center">
        <img src="icons/logo.jpg" alt="">
        <span class="d-none d-lg-block">Statemate</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>
    <!-- End Search Bar -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>
          <!-- End Notification Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>
          </ul>
          <!-- End Notification Dropdown Items -->
        </li>
        <!-- End Notification Nav -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>
          <!-- End Messages Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>
          </ul>
          <!-- End Messages Dropdown Items -->
        </li>
        <!-- End Messages Nav -->
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a>
          <!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
          <!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->
      </ul>
    </nav>
    <!-- End Icons Navigation -->
  </header>
  <!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Contact Page Nav -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi bi-person-bounding-box"></i>
          <span>Customer</span>
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="" class="nav-link collapsed">
          <i class="bi bi-box-arrow-right"></i>
          <span>Log out</span>
        </a>
      </li>
    </ul>
  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">
        <div class="container d-flex flex-column flex-md-row justify-content-between bg-light gap-3">
          <!-- FIRST COLUMN -->
          <div class="col col-lg-3 shadow-sm p-3 p-md-5 border-end border-5 border-secondary-subtle">
            <h1 class="fw-bold">Statement of Account</h1>
            <div>
              <form id="searchSOA" method="post" class="mt-3">
                <div class="d-flex justify-content-center align-items-start gap-1">
                  <input type="checkbox" name="oldData" class="form-check-input" id="oldData">
                  <label class="fw-semibold text-center" for="oldData">View SOA From Old Data</label>
                </div>
                <div class="d-flex flex-column gap-3 mt-3">
                  <div class="d-flex gap-3 align-items-end">
                    <label for="code" class="form-label col-auto">Card Code:</label>
                    <input type="text" class="form-control" name="cardcode" id="code" required>
                  </div>
                  <div class="d-flex gap-3 align-items-end">
                    <label for="name" class="form-label col-auto">Card Name:</label>
                    <input type="text" class="form-control" name="cardname" id="name" required>
                  </div>
                  <div class="d-flex gap-3 align-items-end">
                    <label for="branch" class="form-label col-auto">Branch:</label>
                    <select name="branch" id="branch" class="form-select" required>
                      <option value="AGDAO">AGDAO</option>
                      <option value="SHOWROOM">SHOWROOM</option>
                      <option value="VIAC">VIAC</option>
                    </select>
                  </div>
                  <div class="d-flex gap-3 align-items-end">
                    <label for="si" class="form-label col-auto">MDN/SI #:</label>
                    <input type="text" class="form-control" name="mdn" id="si" required>
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-1 mt-3">
                  <button class="btn btn-primary"><i class="bi bi-search d-block d-md-none"></i> <span class="d-none d-md-inline-flex">Search</span></button>
                  <button class="btn btn-success"><i class="bi bi-arrow-clockwise d-block d-md-none"></i> <span class="d-none d-md-inline-flex">Refresh</span></button>
                </div>
              </form>
              <div class="mt-3">
                <h6>Search Result: </h6>
                <div class="table-responsive">
                  <table class="table datatables table-hover table-striped w-100">
                    <thead>
                      <tr>
                        <th>Card Name</th>
                        <th>MDN/SI #</th>
                        <th>DocStatus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><span class="text-decoration-underline text-primary">PLANTAS</span></td>
                        <td><a href="#">20713</a></td>
                        <td>OPEN</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- MIDDLE COLUMN -->
          <div class="col col-lg-5 shadow-sm p-3 p-md-5 border-end border-5 border-secondary-subtle">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="fw-bold">Customer Details</h1>
              <div class="d-flex gap-2">
                <button class="btn btn-primary" data-bs-toggle="tooltip" title="Preview">Preview</button>
                <button class="btn btn-danger" data-bs-toggle="tooltip" title="Print">Print</button>
              </div>
            </div>
            <form id="userForm" method="post">
              <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3 col-12 col-md-6">
                  <label for="cname" class="col-auto">Customer Name:</label>
                  <input type="text" class="form-control" id="cname" required>
                </div>
                <div class="d-flex align-items-center gap-3 col-12 col-md-6">
                  <label for="address" class="col-auto">Address:</label>
                  <input type="text" class="form-control" id="address" required>
                </div>
                <div class="d-flex flex-column flex-md-row gap-3">
                  <!-- FIRST COLUMN -->
                  <div class="d-flex flex-column gap-3 col">
                    <div class="d-flex flex-column gap-2">
                      <label for="inv_no" class="col-auto">Manual Inv #:</label>
                      <input type="text" class="form-control" name="inv_no" id="inv_no" required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="ddate" class="col-auto">Delivery Date:</label>
                      <input type="text" class="form-control" name="delivery_date" id="ddate" required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="terms" class="col-auto">Terms:</label>
                      <input type="text" class="form-control" name="terms" id="terms" required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="repo" class="col-auto">Repo Status:</label>
                      <input type="text" class="form-control" name="repo" id="repo" required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="uds" class="col-auto">UDS No:</label>
                      <input type="text" class="form-control" name="uds" id="uds" required>
                    </div>
                  </div>
                  <!-- SECOND COLUMN -->
                  <div class="d-flex flex-column gap-3 col">
                    <div>
                      <label for="branch" class="form-label">Branch:</label>
                      <input type="text" class="form-control" name="branch" id="branch" required>
                    </div>
                    <div>
                      <label for="dp" class="form-label">Down Payment:</label>
                      <br>
                      <input type="text" class="form-control" name="down" id="dp" required>
                    </div>
                    <div>
                      <label for="mi" class="form-label">Monthly Installment:</label>
                      <br>
                      <input type="text" class="form-control" name="monthly" id="mi" required>
                    </div>
                    <div>
                      <label for="udate" class="form-label">UDS Date:</label>
                      <br>
                      <input type="text" class="form-control" name="uds_date" id="udate" required>
                    </div>
                    <div>
                      <label for="rdate" class="form-label">Redeem Date:</label>
                      <br>
                      <input type="text" class="form-control" name="redeem_date" id="rdate" required>
                    </div>
                  </div>
                  <!-- THIRD COLUMN -->
                  <div class="d-flex flex-column gap-3 col align-self-start align-self-md-end">
                    <div>
                      <label for="area" class="form-label">Area:</label>
                      <br>
                      <input type="text" class="form-control" name="area" id="area" required>
                    </div>
                    <div>
                      <label for="mbranch" class="form-label">Main Branch:</label>
                      <br>
                      <input type="text" class="form-control" name="mbranch" id="mbranch" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-3">
                <h3 class="fw-bold">Item Details:</h3>
                <div class="table-responsive">
                  <table class="table table-hover table-striped w-100" id="myTable">
                    <thead>
                      <tr>
                        <th>Item Code</th>
                        <th>Description/Model</th>
                        <th>Brand</th>
                        <th>Serial</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>3467</td>
                        <td>Split Type</td>
                        <td>Haier</td>
                        <td>43568</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="table-responsive mt-3 mt-md-5">
                <table class="table table-hover table-striped w-100" id="myTable2">
                  <thead>
                    <tr>
                      <th>DateParticular</th>
                      <th>Particular</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Rebate</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2023-10-01</td>
                      <td>Initial Payment</td>
                      <td>1000.00</td>
                      <td>0.00</td>
                      <td>0.00</td>
                    </tr>
                    <tr>
                      <td>2023-10-15</td>
                      <td>Monthly Installment</td>
                      <td>500.00</td>
                      <td>0.00</td>
                      <td>0.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
          <!-- THIRD COLUMN -->
          <div class="col shadow-sm p-3 py-md-5 border-end border-5 border-secondary-subtle overflow-y-scroll" style="max-height: 90vh">
            <h1 class="fw-bold">Records</h1>
            <div class="list-group list-group-flush gap-3">
              <li class="list-group-item rounded-1 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-start">
                  <h4 class="fw-bold">July 26, 2025</h4>
                  <button type="button" class="btn btn-dark btn-sm">Edit</button>
                </div>
                <hr>
                <div class="d-flex flex-column gap-3">
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Doc Date:</label>
                      <br>
                      <input type="text" class="form-control" name="ddate" value="July 25, 2025" required>
                    </div>
                    <div>
                      <label for="">Date:</label>
                      <br>
                      <input type="text" class="form-control" name="date" value="May 29, 2025" required>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Name:</label>
                      <input type="text" class="form-control" name="name" value="John Doe" required>
                    </div>
                    <div>
                      <label for="">Address:</label>
                      <input type="text" class="form-control" name="address" value="Iloilo City" required>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Account #:</label>
                      <input type="text" class="form-control" name="name" value="356253768" required>
                    </div>
                    <div>
                      <label for="">Unit:</label>
                      <input type="text" class="form-control" name="address" value="Aircon" required>
                    </div>
                  </div>
                  <div>
                    <label for="">Remarks:</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium architecto, tenetur deserunt quas quasi error libero. Sit dolores ea a ad dolor illum, cupiditate nostrum.
                  </textarea>
                  </div>
                </div>
              </li>
              <li class="list-group-item rounded-1 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-start">
                  <h4 class="fw-bold">July 26, 2025</h4>
                  <button type="button" class="btn btn-dark btn-sm">Edit</button>
                </div>
                <hr>
                <div class="d-flex flex-column gap-3">
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Doc Date:</label>
                      <br>
                      <input type="text" class="form-control" name="ddate" value="July 25, 2025" required>
                    </div>
                    <div>
                      <label for="">Date:</label>
                      <br>
                      <input type="text" class="form-control" name="date" value="May 29, 2025" required>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Name:</label>
                      <input type="text" class="form-control" name="name" value="John Doe" required>
                    </div>
                    <div>
                      <label for="">Address:</label>
                      <input type="text" class="form-control" name="address" value="Iloilo City" required>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Account #:</label>
                      <input type="text" class="form-control" name="name" value="356253768" required>
                    </div>
                    <div>
                      <label for="">Unit:</label>
                      <input type="text" class="form-control" name="address" value="Aircon" required>
                    </div>
                  </div>
                  <div>
                    <label for="">Remarks:</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium architecto, tenetur deserunt quas quasi error libero. Sit dolores ea a ad dolor illum, cupiditate nostrum.
                  </textarea>
                  </div>
                </div>
              </li>
              <li class="list-group-item rounded-1 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-start">
                  <h4 class="fw-bold">July 26, 2025</h4>
                  <button type="button" class="btn btn-dark btn-sm">Edit</button>
                </div>
                <hr>
                <div class="d-flex flex-column gap-3">
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Doc Date:</label>
                      <br>
                      <input type="text" class="form-control" name="ddate" value="July 25, 2025" required>
                    </div>
                    <div>
                      <label for="">Date:</label>
                      <br>
                      <input type="text" class="form-control" name="date" value="May 29, 2025" required>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Name:</label>
                      <input type="text" class="form-control" name="name" value="John Doe" required>
                    </div>
                    <div>
                      <label for="">Address:</label>
                      <input type="text" class="form-control" name="address" value="Iloilo City" required>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div>
                      <label for="">Account #:</label>
                      <input type="text" class="form-control" name="name" value="356253768" required>
                    </div>
                    <div>
                      <label for="">Unit:</label>
                      <input type="text" class="form-control" name="address" value="Aircon" required>
                    </div>
                  </div>
                  <div>
                    <label for="">Remarks:</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium architecto, tenetur deserunt quas quasi error libero. Sit dolores ea a ad dolor illum, cupiditate nostrum.
                  </textarea>
                  </div>
                </div>
              </li>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>