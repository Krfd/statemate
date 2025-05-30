$(document).ready(function () {
  $("#commentForm").submit(function (e) {
    e.preventDefault();
    var commentForm = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "functions/postComment.php",
      data: commentForm,
      success: function (res) {
        switch (res) {
          case "posted":
            Swal.fire({
              icon: "success",
              iconColor: "#28a745",
              title: "Post has been added",
              text: "Please wait...",
              timer: 2000,
              timerProgressBar: true,
              showConfirmButton: false,
              allowOutsideClick: false,
              willClose: () => {
                $("#postCommentModal").modal("hide");
                fetchRecentlyAdded();
              },
              customClass: {
                popup: "small-alert",
                title: "small-title",
                content: "small-content",
              },
            });

            break;
          case "invalid":
            Swal.fire({
              icon: "error",
              title: "Invalid Post",
              text: "Please check your inputs",
              confirmButtonText: "Try again",
              confirmButtonColor: "#d33",
              allowOutsideClick: false,
            });
            break;
          default:
            Swal.fire({
              icon: "error",
              title: res,
              confirmButtonText: "OKAY",
              confirmButtonColor: "#d33",
              allowOutsideClick: false,
            });
        }
      },
    });
  });

  function fetchRecentlyAdded() {
    var customerCardCode = $("#customerCardCode").val();
    var customerBranch = $("#customerBranch").val();

    $.ajax({
      type: "POST",
      url: "api/fetchRecords.php",
      data: {
        customerCardCode: customerCardCode,
        customerBranch: customerBranch,
      },
      success: function (res) {
        $(".list-group").html(res);
      },
    });
  }
});
