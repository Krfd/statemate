$(document).ready(function () {
  $("#userForm").submit(function (e) {
    e.preventDefault();
    var userData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "functions/addUser.php",
      data: userData,
      success: function (res) {
        switch (res) {
          case "added":
            Swal.fire({
              icon: "success",
              iconColor: "#28a745",
              title: "User has been created",
              text: "Please wait...",
              timer: 2000,
              timerProgressBar: true,
              showConfirmButton: false,
              allowOutsideClick: false,
              willClose: () => {
                location.reload();
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
              title: "Invalid creating user.",
              text: "Please try again.",
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
});
