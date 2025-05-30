<?php

include("../config/config.php");

$customerCardCode = $_POST['customerCardCode'];
$customerBranch = $_POST['customerBranch'];

// MAKE THIS AN API INSTEAD
$history = $conn->prepare("SELECT * FROM posts WHERE customerCardCode = :customerCardCode AND customerBranch = :customerBranch");
$history->bindParam(":customerCardCode", $customerCardCode);
$history->bindParam(":customerBranch", $customerBranch);
$history->execute();

$getHistory = $history->fetchAll(PDO::FETCH_OBJ);

try {
    if ($getHistory) {
        foreach ($getHistory as $item) {
            $data_id = $item->id;
            $customerId = $item->customerId;
            $customerCardCode = $item->customerCardCode;
            $customerCardName = $item->customerCardName;
            $customerBranch = $item->customerBranch;
            $author = $item->author;
            $remarks = $item->remarks;
            $branch = $item->branch;
            $postingDate = $item->postingDate;
            $createdDate = $item->createdDate;
            $created = $item->created;
            $modified = $item->modified;

            $createdDate = date("M d, Y", strtotime($createdDate));
            $postingDate = date("M d, Y", strtotime($postingDate));

            if (!empty($modified)) {
                $created = date("M d, Y", strtotime($modified));
            } else {
                $created = date("M d, Y", strtotime($created));
            }

            echo '<li class="list-group-item rounded-1 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-start">
                    <h4 class="fw-bold">' . $created . '</h4>
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="edit_' . $data_id . '">Edit</button>
                </div>
                <hr>
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-5">
                    <div class="d-flex flex-column gap-1">
                    <div>
                        <small>Posting Date: <span class="fw-bold">' . $postingDate . '</span></small>
                    </div>
                    <div>
                        <small>Created Date: <span class="fw-bold">' . $createdDate . '</span></small>
                    </div>
                    <div>
                        <small>Author: <span class="fw-bold">' . $author . '</span></small>
                    </div>
                    <div>
                        <small>Branch: <span class="fw-bold">' . $branch . '</span></small>
                    </div>
                    <div>
                        <small>Customer Branch: <span class="fw-bold">' . $customerBranch . '</span></small>
                    </div>
                    <div>
                        <small>Customer Card Code: <span class="fw-bold">' . $customerCardCode . '</span></small>
                    </div>
                    </div>
                    <div class="col">
                    <small>Remarks:</small>
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
