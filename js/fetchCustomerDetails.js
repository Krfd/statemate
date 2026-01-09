let cachedCustomerData = [];

// LOADER
function showLoader() {
  const loader = document.getElementById("loader");
  if (loader) {
    Object.assign(loader.style, {
      position: "fixed",
      top: "0",
      left: "0",
      width: "100vw",
      height: "100vh",
      background: "rgba(255, 255, 255, 0.6)",
      zIndex: "9999",
      display: "flex",
      justifyContent: "center",
      alignItems: "center",
      pointerEvents: "all",
    });
  }
}

function hideLoader() {
  document.getElementById("loader").style.display = "none";
}

// END LOADER

async function fetchData(event) {
  event.preventDefault();

  showLoader();
  const loaderStartTime = Date.now();
  // CLEARING THE FORM FIELDS
  const userForm = document.getElementById("userForm");
  const itemDetails = document.getElementById("itemDetails");
  const itemPayments = document.getElementById("itemPayments");

  userForm.reset();
  itemDetails.innerHTML = "";
  itemPayments.innerHTML = "";
  const searchResults = document.getElementById("searchResults");
  searchResults.innerHTML = "";
  const unitHistory = document.getElementById("unitHistory");
  unitHistory.classList.add("d-none");
  unitHistory.classList.remove("d-block");

  const formData = new FormData(document.getElementById("searchSOA"));

  try {
    const response = await fetch("api/getCustomerDetails.php", {
      method: "POST",
      body: formData,
    });

    const textResponse = await response.text();

    if (textResponse.length === 0) {
      Swal.fire({
        icon: "info",
        title: "No Customer Details Found",
        text: "Please check the details you entered.",
        confirmButtonText: "OKAY",
      });
      return;
    }

    if (response.ok) {
      const data = JSON.parse(textResponse);
      cachedCustomerData = data;

      const tableBody = document.getElementById("searchResults");
      tableBody.innerHTML = "";

      if (data.length === 0) {
        tableBody.innerHTML =
          '<tr><td colspan="4" class="text-center">No records found</td></tr>';

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
        <td><span class="text-decoration-underline text-primary" data-id="${item.DocEntry}" style="cursor: pointer">${item.CardName}</span></td>
        <td colspan="2"><a href="#" class="text-decoration-none" data-id="${item.DocEntry}">${item.U_MDN}</a></td>
        <td>${item.DocStatus}</td>
      `;
        tableBody.appendChild(row);
        // console.log(`U_MDN: ${item.U_MDN}`);
      });

      document.querySelectorAll("[data-id]").forEach((element) => {
        element.addEventListener("click", handleCustomerDetails);
      });
    } else {
      console.error("Error response from server:", textResponse);
      Swal.fire({
        icon: "error",
        title: "Server Error",
        text: "An error occurred while fetching data.",
      });
    }
  } catch (error) {
    Swal.close();
    console.error("Error fetching data:", error);
    Swal.fire({
      icon: "error",
      title: "Network Error",
      text: "Failed to fetch data. Please try again.",
    });
  } finally {
    const elapsed = Date.now() - loaderStartTime;
    const minimumDuration = 500;

    if (elapsed < minimumDuration) {
      setTimeout(hideLoader, minimumDuration - elapsed);
    } else {
      hideLoader();
    }
  }
}

async function handleCustomerDetails(event) {
  event.preventDefault();

  const id = event.target.getAttribute("data-id");

  // PASSING PARAMETER FOR LEDGER
  fetch(`api/ledger.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "docEntry=" + encodeURIComponent(id),
  })
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("ledgerBody").innerHTML = html;
    });

  // ARREARS
  const upTo30 = document.getElementById("upTo30");
  const upTo60 = document.getElementById("upTo60");
  const upTo90 = document.getElementById("upTo90");
  const over360 = document.getElementById("over360");
  const totalArrears = document.getElementById("totalArrears");
  const totalPenalty = document.getElementById("totalPenalty");
  const balance = document.getElementById("balance");
  fetch(`api/arrears.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "docEntry=" + encodeURIComponent(id),
  })
    .then((response) => response.json())
    .then((data) => {
      const format = (val) =>
        !isNaN(val) && val !== null
          ? parseFloat(val).toLocaleString("en-US", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })
          : "0.00";

      if (upTo30) upTo30.innerHTML = format(data.upTo30);
      if (upTo60) upTo60.innerHTML = format(data.upTo60);
      if (upTo90) upTo90.innerHTML = format(data.upTo90);
      if (over360) over360.innerHTML = format(data.over360);
      if (totalArrears) totalArrears.innerHTML = format(data.totalArrears);
      if (totalPenalty) totalPenalty.innerHTML = format(data.totalPenalty);
      if (balance) balance.innerHTML = format(data.balance);
    });

  const customer = cachedCustomerData.find((item) => item.DocEntry == id);

  if (!customer) {
    console.error("Customer data not found for DocEntry:", id);
    return;
  }

  const unitHistory = document.getElementById("unitHistory");
  unitHistory.classList.remove("d-none");
  unitHistory.classList.add("d-block");

  document.getElementById("cname").value = customer.CardName || "";
  document.getElementById("address").value = customer.Address || "";
  document.getElementById("inv_no").value = customer.DocNum || "";
  document.getElementById("ddate").value =
    customer.U_MDN || ""
      ? new Date(customer.DocDate).toLocaleString("en-US", {
          year: "numeric",
          month: "long",
          day: "numeric",
          hour: "numeric",
          minute: "2-digit",
          hour12: true,
        })
      : "";
  document.getElementById("terms").value = customer.Installmnt || "";
  document.getElementById("repo").value =
    customer.U_RepoStatus == 0 || !customer.U_RepoStatus
      ? ""
      : customer.U_RepoStatus || "";
  document.getElementById("uds").value =
    customer.U_UDSN == 0 || !customer.U_UDSN ? "" : customer.U_UDSN || "";
  document.getElementById("branch_").value = customer.Branch || "";
  document.getElementById("dp").value =
    customer.DpmAmnt === 0
      ? "0.00"
      : customer.DpmAmnt
      ? new Intl.NumberFormat().format(customer.DpmAmnt)
      : "";
  document.getElementById("mi").value = (Number(customer.MoInst) || 0).toFixed(
    2
  );
  document.getElementById("udate").value =
    (customer.U_UDSD === "01/01/1900" ? "" : customer.U_UDSD) || "";
  document.getElementById("rdate").value =
    (customer.U_REDMD === "01/01/1900" ? "" : customer.U_REDMD) || "";
  document.getElementById("area").value = customer.PoNo || "";
  document.getElementById("mbranch").value = customer.Branch || "";

  const customerId = document.getElementById("customerId");
  const customerCard = document.getElementById("customerCardCode");
  const customerName = document.getElementById("customerCardName");
  const customerBranch = document.getElementById("customerBranch");

  if (customerId) customerId.value = customer.Series;
  if (customerCard) customerCard.value = customer.CardCode;
  if (customerName) customerName.value = customer.CardName;
  if (customerBranch) customerBranch.value = customer.Branch;

  const postBtn = document.getElementById("postCommentBtn");
  if (postBtn) {
    postBtn.disabled = false;
  }

  try {
    const response = await fetch("api/getMoreCustomerDetails.php", {
      method: "POST",
      body: new URLSearchParams({
        id,
      }),
    });

    const data = await response.json();

    if (data.length > 0) {
      displayTableData(
        data,
        customer.U_MDN,
        customer.CardCode,
        customer.DocEntry
      );
    } else {
      console.error("No data found for the selected customer");
    }
  } catch (error) {
    console.error("Error fetching additional details:", error);
  }
}

async function displayTableData(data, umdn, cardcode, docentry) {
  const itemTables = document.getElementById("itemDetails");
  itemTables.innerHTML = "";

  if (data.length === 0) {
    itemTables.innerHTML = `<tr><td colspan="4" class="text-center">No records found</td></tr>`;

    Swal.fire({
      icon: "info",
      title: "No Customer Details Found",
      text: "Please check the details you entered.",
      confirmButtonText: "OKAY",
    });

    return;
  }

  data.forEach((unit) => {
    const record = document.createElement("tr");
    record.innerHTML = `
    <td class="text-primary">${unit.ItemCode}</td>
    <td>${unit.Model}</td>
    <td>${unit.Brand}</td>
    <td>${unit.Serial}</td>`;

    itemTables.appendChild(record);
  });

  try {
    const paymentDetails = await fetch("api/getPaymentDetails.php", {
      method: "POST",
      body: new URLSearchParams({
        u_mdn: umdn,
        cardCode: cardcode,
        docEntry: docentry,
      }),
    });

    if (!paymentDetails.ok) {
      throw new Error(`HTTP error! status: ${paymentDetails.status}`);
    }

    const payments = await paymentDetails.json();

    const hasPaymentData =
      Array.isArray(payments.merged) && payments.merged.length > 0;

    if (hasPaymentData) {
      document.getElementById("itemPayments").innerHTML = "";
      displayPaymentData(payments.merged, umdn);
    } else {
      Swal.fire({
        title: "No Payment Data",
        text: "No payment data was returned or it's empty.",
        icon: "warning",
        confirmButtonText: "OK",
      });
    }
  } catch (error) {
    console.error("Error fetching payment details:", error);
  }
}

function displayPaymentData(payments, mdn) {
  const paymentTables = document.getElementById("itemPayments");

  if (!Array.isArray(payments) || payments.length === 0) {
    return;
  }

  // Create two arrays: one for "DEL" transactions and another for the rest
  const delPayments = [];
  const regularPayments = [];

  // Split the payments into two categories
  payments.forEach((data) => {
    if (data?.Trans === "DEL") {
      delPayments.push(data); // Store "DEL" transactions separately
    } else {
      regularPayments.push(data); // Store the rest of the transactions
    }
  });

  // Combine "DEL" payments at the beginning, followed by regular payments
  const sortedPayments = [...delPayments, ...regularPayments];

  sortedPayments.forEach((data) => {
    const row = document.createElement("tr");

    console.log(data);

    const formattedAmount = data?.DocTotal
      ? parseFloat(data.DocTotal)
          .toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
          .toLocaleString()
      : "";

    const sumApplied = data?.SumApplied
      ? parseFloat(data.SumApplied)
          .toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
          .toLocaleString()
      : "";

    const debit = data?.Debit
      ? parseFloat(data.Debit)
          .toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
          .toLocaleString()
      : "";

    const counterRef = data?.CounterRef;

    let sourceTable = "";
    let docNum = data?.docNum || "";

    switch (data?.source) {
      case "reversal":
        sourceTable = "JE";
        break;
      case "penalty":
        sourceTable = "JE";
        break;
      case "credit":
        sourceTable = "CR";
        break;
      case "down_payment":
        sourceTable = "DPM";
        break;
      case "invoice":
        sourceTable = "INV";
        break;
      case "debit":
        sourceTable = "JE";
        break;
      case "dpm":
        sourceTable = "DPM";
        break;
      default:
        sourceTable = "";
    }

    console.log(``);
    console.log(`DEBIT: ${debit}`);
    console.log(`CREDIT: ${formattedAmount}`);
    console.log(``);

    row.innerHTML = `
      <td>${data?.DocDate || ""}</td>
      <td>${sourceTable} ${counterRef ? counterRef : docNum} ${
      data?.TransId || ""
    } ${data?.Trans || mdn}</td>
      <td></td>
      <td></td>
      <td>${debit ? debit : formattedAmount}</td>
      <td> ${sumApplied}</td>
      <td></td>`;

    paymentTables.appendChild(row);
  });
}
