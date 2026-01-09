<?php
include("config/config.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Statemate - Statement of Account</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="icons/logo.jpg" rel="icon">
  <link href="icons/logo.jpg" rel="IAP">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="lib/sweetalert/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    .loader {
      color: #000;
      font-size: 45px;
      text-indent: -9999em;
      overflow: hidden;
      width: 1em;
      height: 1em;
      border-radius: 50%;
      position: relative;
      transform: translateZ(0);
      animation: mltShdSpin 1.7s infinite ease, round 1.7s infinite ease;
    }

    @keyframes mltShdSpin {
      0% {
        box-shadow: 0 -0.83em 0 -0.4em,
          0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em,
          0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }

      5%,
      95% {
        box-shadow: 0 -0.83em 0 -0.4em,
          0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em,
          0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }

      10%,
      59% {
        box-shadow: 0 -0.83em 0 -0.4em,
          -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em,
          -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
      }

      20% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em,
          -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em,
          -0.749em -0.34em 0 -0.477em;
      }

      38% {
        box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em,
          -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em,
          -0.82em -0.09em 0 -0.477em;
      }

      100% {
        box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
          0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
      }
    }

    @keyframes round {
      0% {
        transform: rotate(0deg)
      }

      100% {
        transform: rotate(360deg)
      }
    }

    .loader-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(255, 255, 255, 0.6);
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
      pointer-events: all;
    }

    #loader {
      display: none;
    }

    .overall-progress {
      overflow-y: auto;
    }

    .overall-progress::-webkit-scrollbar {
      width: 5px;
    }

    .overall-progress::-webkit-scrollbar-track {
      background: #CECECE;
      border-radius: 50px;
    }

    .overall-progress::-webkit-scrollbar-thumb {
      background: #33A1F1;
      border-radius: 50px;
    }

    table thead {
      position: sticky;
      top: 0;
      z-index: 1;
      /* Make sure the header stays above other content */
      background-color: #f8f9fa
    }
  </style>
</head>

<body>
  <!-- Loader overlay on top -->
  <div class="loader-overlay" id="loader">
    <div class="loader"></div>
  </div>
  <!-- POST COMMENT MODAL -->
  <div class="modal fade" id="postCommentModal" tabindex="-1" aria-labelledby="postCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="postCommentModalLabel">Post a Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="commentForm" method="post">
            <div class="d-flex justify-content-between gap-3 col-12 mb-3">
              <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
              <input type="hidden" name="customerId" id="customerId">
              <input type="hidden" name="customerCardCode" id="customerCardCode">
              <input type="hidden" name="customerCardName" id="customerCardName">
              <input type="hidden" name="customerBranch" id="customerBranch">
              <div class="col">
                <label for="author">Author:</label>
                <input type="text" name="author" class="form-control" id="author" value="<?php echo $name ?>" readonly required>
              </div>
              <div class="col">
                <label for="branchName">Branch:</label>
                <!-- <select name="branchName" id="branchName" class="form-select" required>
                  <option value="AGDAO">AGDAO</option>
                  <option value="SHOWROOM">SHOWROOM</option>
                  <option value="VIAC">VIAC</option>
                </select> -->
                <input type="text" name="branchName" id="branchName" value="<?php echo $branch ?>" class="form-control" readonly required>
              </div>
            </div>
            <div class="d-flex justify-content-between gap-3 col-12 mb-3">
              <div class="col">
                <label for="postingDate">Posting Date:</label>
                <input type="date" class="form-control" name="postingDate" id="postingDate" required>
              </div>
              <div class="col">
                <label for="createdDate">Created Date:</label>
                <input type="date" class="form-control" name="createdDate" id="createdDate" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="commentText" class="form-label">Remarks:</label>
              <textarea class="form-control" id="commentText" rows="4" name="remarks" required></textarea>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" class="btn btn-primary">Post</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.html" class="logo d-flex align-items-center">
        <img src="icons/logo.jpg" alt="">
        <span class="d-none d-lg-block">Statemate</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Icons Navigation -->
  </header>
  <!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi bi-person-bounding-box"></i>
          <span>Statement of Account</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="profile.php" class="nav-link collapsed">
          <i class="bi bi-box-arrow-right"></i>
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
  <!-- LOGOUT -->
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
            <a href="config/config.php?logout=true" class="text-decoration-none"><strong>Logout</strong></a>
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
    <section class="section dashboard">
      <div class="row">
        <div class="container d-flex flex-column flex-lg-row justify-content-between bg-light gap-3">
          <!-- FIRST COLUMN -->
          <div class="col col-lg-3 shadow-sm p-3 p-md-5 border-end border-5 border-secondary-subtle overall-progress" style="max-height: 90vh">
            <h1 class="fw-bold">Statement of Account</h1>
            <div>
              <form id="searchSOA" method="post" class="mt-3" onsubmit="fetchData(event)">
                <div class="d-flex justify-content-center align-items-start gap-1">
                  <input type="checkbox" name="oldData" class="form-check-input" id="oldData">
                  <label class="fw-semibold text-center" for="oldData">View SOA From Old Data</label>
                </div>
                <div class="d-flex flex-column gap-3 mt-3">
                  <div class="d-flex gap-3 align-items-end">
                    <label for="code" class="form-label col-auto">Card Code:</label>
                    <input type="text" class="form-control" name="cardcode" id="code" style="margin-left: 5px;">
                  </div>
                  <div class="d-flex gap-3 align-items-end">
                    <label for="name" class="form-label col-auto">Card Name:</label>
                    <input type="text" class="form-control" name="cardname" id="name">
                  </div>
                  <div class=" d-flex gap-3 align-items-end">
                    <label for="branch" class="form-label col-auto">Branch:</label>
                    <select name="branch" id="branch" class="form-select" style="margin-left: 30px;" required>
                      <option value="" selected>Select Branch</option>
                      <option value="Agdao">AGDAO</option>
                      <option value="Showroom">SHOWROOM</option>
                      <option value="Viac">VIAC</option>
                      <option value="Cadiz">CADIZ</option>
                    </select>
                  </div>
                  <div class="d-flex gap-3 align-items-end">
                    <label for="si" class="form-label col-auto">MDN/SI #:</label>
                    <input type="text" class="form-control" name="mdn" id="si" style="margin-left: 10px;">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-1 mt-3">
                  <button type="submit" class="btn btn-primary"><i class="bi bi-search d-block d-md-none"></i> <span class="d-none d-md-inline-flex">Search</span></button>
                  <button onclick="location.reload()" class="btn btn-success"><i class="bi bi-arrow-clockwise d-block d-md-none"></i> <span class="d-none d-md-inline-flex">Refresh</span></button>
                </div>
              </form>
              <div class="my-3">
                <h6>Search Result: </h6>
                <div class="table-responsive overflow-y-auto" style="max-height: 300px">
                  <table class="table datatables table-hover table-striped w-100">
                    <thead>
                      <tr>
                        <th>Card Name</th>
                        <th colspan="2">MDN/SI #</th>
                        <th>DocStatus</th>
                      </tr>
                    </thead>
                    <tbody id="searchResults">
                      <tr>
                        <td colspan="4" class="text-center">No Data Found</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="d-flex flex-column gap-2 mt-3 border rounded p-3 d-none" id="unitHistory">
                <div class="d-flex gap-3">
                  <button class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#transactions">Transaction(s)</button>
                  <button class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#ledger">Ledger</button>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <div class="fw-bold">1 - 30 Days</div>
                  <div id="upTo30">0.00</div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <div class="fw-bold">31 - 60 Days</div>
                  <div id="upTo60">0.00</div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <div class="fw-bold">61 - 90 Days</div>
                  <div id="upTo90">0.00</div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <div class="fw-bold">Over 360 Days</div>
                  <div id="over360">0.00</div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <div class="fw-bold">Total Arrears</div>
                  <div id="totalArrears">0.00</div>
                </div>
                <div class="d-flex justify-content-between border-bottom py-2">
                  <div class="fw-bold">Total Penalty</div>
                  <div id="totalPenalty">0.00</div>
                </div>
                <div class="d-flex justify-content-between py-2">
                  <div class="fw-bold">Balance</div>
                  <div id="balance">0.00</div>
                </div>
              </div>
            </div>
          </div>
          <!-- MIDDLE COLUMN -->
          <div class="col col-lg-5 shadow-sm p-3 p-md-5 border-end border-5 border-secondary-subtle overall-progress" style="max-height: 90vh">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="fw-bold">Customer Details</h1>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Post a Comment" id="postCommentBtn" disabled>
                  <i class="bi bi-chat-right-dots d-block d-md-none"></i>
                  <span class="d-none d-md-block">Post</span>
                </button>
              </div>
            </div>
            <form id="userForm" method="post" class="mt-3">
              <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3 col-12 col-md-auto">
                  <label for="cname" class="col-auto">Customer Name:</label>
                  <input type="text" class="form-control" id="cname" readonly required>
                </div>
                <div class="d-flex align-items-center gap-3 col-12 col-md-auto">
                  <label for="address" class="col-auto">Address:</label>
                  <input type="text" class="form-control" style="margin-left: 60px;" id="address" readonly required>
                </div>
                <div class="d-flex flex-column flex-md-row gap-3">
                  <!-- FIRST COLUMN -->
                  <div class="d-flex flex-column gap-3 col">
                    <div class="d-flex flex-column gap-2">
                      <label for="inv_no" class="col-auto">Manual Inv #:</label>
                      <input type="text" class="form-control" name="inv_no" id="inv_no" readonly required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="ddate" class="col-auto">Delivery Date:</label>
                      <input type="text" class="form-control" name="delivery_date" id="ddate" readonly required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="terms" class="col-auto">Terms:</label>
                      <input type="text" class="form-control" name="terms" id="terms" readonly required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="repo" class="col-auto">Repo Status:</label>
                      <input type="text" class="form-control" name="repo" id="repo" readonly required>
                    </div>
                    <div class="d-flex flex-column gap-2">
                      <label for="uds" class="col-auto">UDS No:</label>
                      <input type="text" class="form-control" name="uds" id="uds" readonly required>
                    </div>
                  </div>
                  <!-- SECOND COLUMN -->
                  <div class="d-flex flex-column gap-3 col">
                    <div>
                      <label for="branch" class="form-label">Branch:</label>
                      <input type="text" class="form-control" name="branch" id="branch_" readonly required>
                    </div>
                    <div>
                      <label for="dp" class="form-label">Down Payment:</label>
                      <br>
                      <input type="text" class="form-control" name="down" id="dp" readonly required>
                    </div>
                    <div>
                      <label for="mi" class="form-label">Monthly Installment:</label>
                      <br>
                      <input type="text" class="form-control" name="monthly" id="mi" readonly required>
                    </div>
                    <div>
                      <label for="udate" class="form-label">UDS Date:</label>
                      <br>
                      <input type="text" class="form-control" name="uds_date" id="udate" readonly required>
                    </div>
                    <div>
                      <label for="rdate" class="form-label">Redeem Date:</label>
                      <br>
                      <input type="text" class="form-control" name="redeem_date" id="rdate" readonly required>
                    </div>
                  </div>
                  <!-- THIRD COLUMN -->
                  <div class="d-flex flex-row flex-md-column gap-3 align-self-start align-self-md-end col col-lg-3">
                    <div>
                      <label for="area" class="form-label">Area:</label>
                      <br>
                      <input type="text" class="form-control" name="area" id="area" readonly required>
                    </div>
                    <div>
                      <label for="mbranch" class="form-label">Main Branch:</label>
                      <br>
                      <input type="text" class="form-control" name="mbranch" id="mbranch" readonly required>
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
                    <tbody id="itemDetails">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="table-responsive mt-3 mt-md-5 overall-progress" style="max-height: 300px;">
                <table class="table table-hover table-striped w-100 datatables" id="myTable2">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th colspan="3">Particular</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Rebate</th>
                    </tr>
                  </thead>
                  <tbody id="itemPayments">
                  </tbody>
                </table>
              </div>
            </form>
          </div>
          <!-- THIRD COLUMN -->
          <div class="col shadow-sm p-3 py-md-5 border-end border-5 border-secondary-subtle overall-progress" style="max-height: 90vh">
            <h1 class="fw-bold">Records</h1>
            <div class="list-group list-group-flush gap-3">
              <?php
              // MAKE THIS AN API INSTEAD
              $history = $conn->prepare("SELECT * FROM posts ORDER BY created_date DESC");
              // ADD IN THE CONDITION (CUSTOMER CARD CODE, BRANCH)
              $history->execute();

              $getHistory = $history->fetchAll(PDO::FETCH_OBJ);

              try {
                if ($getHistory) {
                  foreach ($getHistory as $item) {
                    $data_id = $item->id;
                    $customerId = $item->cust_id;
                    $customerCardCode = $item->cust_cardCode;
                    $customerCardName = $item->cust_cardName;
                    $customerBranch = $item->cust_branch;
                    $author = $item->author;
                    $remarks = $item->remarks;
                    $branch = $item->branch;
                    $postingDate = $item->post_date;
                    $createdDate = $item->created_date;
                    $modified = $item->modified;

                    $createdDate = date("M d, Y", strtotime($createdDate));
                    $postingDate = date("M d, Y", strtotime($postingDate));

                    if (!empty($modified)) {
                      $created = date("M d, Y", strtotime($modified));
                    } else {
                      $created = date("M d, Y", strtotime($createdDate));
                    }

                    echo '<li class="list-group-item rounded-1 p-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                      <h4 class="fw-bold">' . $created . '</h4>
                      <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="' . $data_id . '">Edit</button>
                    </div>
                    <hr>
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-5">
                      <div class="d-flex flex-column gap-1">
                        <div>
                          <small>Posting Date: ' . $postingDate . '</small>
                        </div>
                        <div>
                          <small>Created Date: ' . $createdDate . '</small>
                        </div>
                        <div>
                          <small>Author: ' . $author . '</small>
                        </div>
                        <div>
                          <small>Branch: ' . $branch . '</small>
                        </div>
                        <div>
                          <small>Customer Branch: ' . $customerBranch . '</small>
                        </div>
                        <div>
                          <small>Customer Card Code: ' . $customerCardCode . '</small>
                        </div>
                      </div>
                      <div class="col">
                        <small class="fw-bold">Remarks:</small>
                        <div class="small border-top border-1 mt-2 pt-2">' . $remarks . '</div>
                      </div>
                    </div>
                  </li>';
                  }
                } else {
                  echo '<li class="list-group rounded-1 p-3 shadow-sm">
                <div>
                  <h4 class="fw-bold">No Record Found.</h4>
                </div>
              </li>';
                }
              } catch (PDOException $e) {
                errorHandler(E_WARNING, $e->getMessage(), $e->getFile(), $e->getLine());
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

  <!-- LEDGER -->
  <div class="modal fade" tabindex="-1" role="dialog" id="ledger">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content rounded-3 shadow">
        <div class="modal-body p-4 text-center">
          <h2 class="fw-bold">Ledger</h2>
          <div class="table-responsive">
            <table class="table table-borderless datatables" id="myTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Due</th>
                  <th>Total</th>
                  <th>Paid</th>
                  <th>Days</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="ledgerBody">
                <!-- BODY FROM API LEDGER.PHP -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- TRANSACTIONS -->
  <div class="modal fade" tabindex="-1" role="dialog" id="transactions">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content rounded-3 shadow">
        <div class="modal-body p-4 text-center">
          <h2 class="fw-bold">Transactions</h2>
          <div class="table-responsive">
            <table class="table table-borderless datatables" id="transTable">

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

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
  <script src="lib/sweetalert/dist/sweetalert2.all.min.js"></script>
  <script src="lib/jquery/jquery-3.7.1.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="js/fetchCustomerDetails.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Initialize Tooltip
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });

      // Initialize Modal Trigger for Post Comment Button
      document.getElementById("postCommentBtn").addEventListener("click", function() {
        var myModal = new bootstrap.Modal(document.getElementById('postCommentModal'));
        myModal.show();
      });
    });
  </script>
  <script src="js/postComment.js"></script>
  <script>
    setInterval(function() {
      // Call the same PHP file
      fetch('<?= $_SERVER['PHP_SELF'] ?>', {
          method: 'GET',
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.text())
        .then(data => {
          if (data) {
            document.getElementById('userActivity').innerHTML = data;
          }
          //  else {
          //   document.getElementById('userActivity').innerHTML = "<p>No activities...</p>";
          // }

        });
    }, 1000);
  </script>
</body>

</html>