<div class="modal fade p-4" id="createUser">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-body p-4">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="text-center fw-bold">Add User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="userForm" class="mt-3 mb-0" method="post">
                    <div class="form-floating">
                        <input type="text" class="form-control text-capitalize" name="uname" id="uname" placeholder="Name" required autocomplete="off" maxlength="20">
                        <label for="uname" class="form-label">Name</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="text" name="dept" id="dept" class="form-control" placeholder="Department" required autocomplete="off" maxlength="20">
                        <label for="dept" class="form-label">Department</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="text" class="form-control" name="branch" id="branch" placeholder="Branch">
                        <label for="branch" class="form-label">Branch</label>
                    </div>
                    <div class="flex nowrap p-0">
                        <button type="submit" class="btn d-block mx-auto btn-link fs-6 text-decoration-none m-0 mt-3 rounded-0">
                            <strong>Create</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>