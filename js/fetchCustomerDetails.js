async function fetchData(event) {
  event.preventDefault();

  const formData = new FormData(document.getElementById("searchSOA"));

  try {
    // Send data to the server using fetch (AJAX)
    const response = await fetch("api/getCustomerDetails.php", {
      method: "POST",
      body: formData,
    });

    const textResponse = await response.text();
    console.log("Response Text:", textResponse);

    if (response.ok) {
      const data = JSON.parse(textResponse);

      // Clear previous results
      const tableBody = document.getElementById("searchResults");
      tableBody.innerHTML = "";

      // Check if data is available
      if (data.length === 0) {
        tableBody.innerHTML =
          '<tr><td colspan="3" class="text-center">No records found</td></tr>';

        Swal.fire({
          icon: "info",
          title: "No Customer Details Found",
          text: "Please check the details you entered.",
          confirmButtonText: "OKAY",
        });

        return;
      }

      data.forEach((item) => {
        const row = document.createElement("tr");
        row.innerHTML = `
        <td><span class="text-decoration-underline text-primary" data-id="${item.id}" style="cursor: pointer">${item.cardName}</span></td>
        <td><a href="#" class="text-decoration-none" data-id="${item.id}">${item.mdn}</a></td>
        <td>${item.repo_status}</td>
      `;
        tableBody.appendChild(row);
      });

      document.querySelectorAll("[data-id]").forEach((element) => {
        element.addEventListener("click", handleCustomerDetails);
      });
    } else {
      console.error("Error response from server:", textResponse);
    }
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

async function handleCustomerDetails(event) {
  event.preventDefault();

  const id = event.target.getAttribute("data-id");

  try {
    // Fetch additional details based on mdn or cardName
    const response = await fetch("api/getMoreCustomerDetails.php", {
      method: "POST",
      body: new URLSearchParams({
        id,
      }),
    });

    const data = await response.json();
    console.log("Detailed Data:", data);

    const postBtn = document.getElementById("postCommentBtn");
    if (postBtn) {
      postBtn.disabled = false;
    }

    // If we get a non-empty response, pass the first element
    if (data.length > 0) {
      displayAdditionalDetails(data[0]); // Access the first customer from the response array
    } else {
      console.error("No data found for the selected customer");
    }
  } catch (error) {
    console.error("Error fetching additional details:", error);
  }
}

function displayAdditionalDetails(data) {
  // Set form values with data received from the API
  document.getElementById("cname").value = data.customer || "";
  document.getElementById("address").value = data.address || "";
  document.getElementById("inv_no").value = data.inv_num || "";
  document.getElementById("ddate").value = data.deliveryDate
    ? new Date(data.deliveryDate).toLocaleString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "2-digit",
        hour12: true,
      })
    : "";
  document.getElementById("terms").value = data.terms || "";
  document.getElementById("repo").value = data.repo_status || "";
  document.getElementById("uds").value = data.uds_no || "";
  document.getElementById("branch_").value = data.branch || "";
  document.getElementById("dp").value = data.down
    ? new Intl.NumberFormat().format(data.down)
    : "";
  document.getElementById("mi").value = data.installment || "";
  document.getElementById("udate").value = data.uds_date || "";
  document.getElementById("rdate").value = data.redeem_date || "";
  document.getElementById("area").value = data.area || "";
  document.getElementById("mbranch").value = data.mainBranch || "";

  const customerId = document.getElementById("customerId");
  const customerCard = document.getElementById("customerCardCode");
  const customerName = document.getElementById("customerCardName");
  const customerBranch = document.getElementById("customerBranch");
  if (customerId) {
    customerId.value = data.id;
  }
  if (customerCard) {
    customerCard.value = data.cardCode;
  }
  if (customerName) {
    customerName.value = data.cardName;
  }
  if (customerBranch) {
    customerBranch.value = data.branch;
  }

  $.ajax({
    type: "POST",
    url: "api/fetchRecords.php",
    data: {
      customerCardCode: data.cardCode,
      customerBranch: data.branch,
    },
    success: function (res) {
      $(".list-group").html(res);
    },
  });
}
