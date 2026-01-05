let currentTab = "memberships";

// -------------------
// Show tab function
// -------------------
function showTab(tab) {
  currentTab = tab;

  document.querySelectorAll(".tab-content").forEach((div) =>
    div.classList.remove("active")
  );
  const activeTab = document.getElementById(tab);
  if (activeTab) activeTab.classList.add("active");

  document.querySelectorAll(".sidebar-menu button").forEach((btn) =>
    btn.classList.remove("active")
  );
  const activeBtn = document.querySelector(
    `.sidebar-menu button[onclick="showTab('${tab}')"]`
  );
  if (activeBtn) activeBtn.classList.add("active");

  if (tab === "users") {
    loadUsers();
  } else {
    loadData(tab);
  }
}

// -------------------
// Load memberships / donors data (UNCHANGED)
// -------------------
function loadData(type) {
  fetch(`fetch_data.php?type=${type}`)
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.querySelector(`#${type}Table tbody`);
      if (!tbody) return;
      tbody.innerHTML = "";

      data.forEach((row) => {
        const tr = document.createElement("tr");

        for (let key in row) {
          const td = document.createElement("td");
          td.dataset.field = key;

          if (key.toLowerCase() === "status") {
            td.textContent = row[key];
          } else {
            td.textContent = row[key];
            td.contentEditable = "true";
          }
          tr.appendChild(td);
        }

        const idField = type === "memberships" ? "MEMBER_ID" : "DONOR_ID";

        const actionTd = document.createElement("td");

        const approveBtn = document.createElement("button");
        approveBtn.textContent =
          row["STATUS"]?.toLowerCase() === "approved" ? "Approved" : "Approve";
        approveBtn.className =
          row["STATUS"]?.toLowerCase() === "approved" ? "approved" : "approve";
        approveBtn.disabled = row["STATUS"]?.toLowerCase() === "approved";
        approveBtn.addEventListener("click", () =>
          approveRow(approveBtn, type, row[idField])
        );

        const updateBtn = document.createElement("button");
        updateBtn.textContent = "Update";
        updateBtn.className = "update";
        updateBtn.addEventListener("click", () =>
          updateRow(updateBtn, type, row[idField])
        );

        const deleteBtn = document.createElement("button");
        deleteBtn.textContent = "Delete";
        deleteBtn.className = "delete";
        deleteBtn.addEventListener("click", () =>
          deleteRow(deleteBtn, type, row[idField])
        );

        actionTd.appendChild(approveBtn);
        actionTd.appendChild(updateBtn);
        actionTd.appendChild(deleteBtn);

        tr.appendChild(actionTd);
        tbody.appendChild(tr);
      });
    });
}

// -------------------
// Approve / Update / Delete (UNCHANGED)
// -------------------
function approveRow(btn, type, id) {
  fetch("approve_member.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ id, type }),
  })
    .then((res) => res.json())
    .then((r) => {
      alert(r.status);
    });
}

function updateRow(btn, type, id) {
  const tds = btn.parentElement.parentElement.querySelectorAll(
    "td[contenteditable]"
  );
  const data = { id, type };
  tds.forEach((td) => (data[td.dataset.field] = td.innerText));

  fetch("update_record.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams(data),
  })
    .then((res) => res.json())
    .then((r) => alert(r.status));
}

function deleteRow(btn, type, id) {
  if (!confirm("Are you sure you want to delete this record?")) return;

  fetch("delete_record.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ id, type }),
  })
    .then((res) => res.json())
    .then((r) => {
      alert(r.status);
      btn.parentElement.parentElement.remove();
    });
}

// -------------------
// Search table (UNCHANGED)
// -------------------
function searchTable() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const table =
    currentTab === "memberships"
      ? document.getElementById("membershipsTable")
      : currentTab === "donors"
      ? document.getElementById("donorsTable")
      : document.getElementById("usersTable");

  const rows = table.getElementsByTagName("tr");
  for (let i = 1; i < rows.length; i++) {
    rows[i].style.display = Array.from(rows[i].getElementsByTagName("td")).some(
      (td) => td.innerText.toLowerCase().includes(input)
    )
      ? ""
      : "none";
  }
}

// -------------------
// Logout
// -------------------
function logout() {
  if (confirm("Are you sure you want to logout?")) {
    window.location.href = "logout.php";
  }
}

// -------------------
// Users Loader (UPDATED – no Update button)
// -------------------
async function loadUsers() {
  const tableBody = document.querySelector("#usersTable tbody");
  if (!tableBody) return;

  try {
    const res = await fetch("api_get_all_user.php");
    const result = await res.json();

    tableBody.innerHTML = "";

    if (result.status === "success" && Array.isArray(result.data)) {
      result.data.forEach((user) => {
        const row = document.createElement("tr");

        row.innerHTML = `
          <td>${user.USER_ID}</td>
          <td>${user.u_id ?? ""}</td>
          <td>${user.NAME}</td>
          <td>${user.EMAIL}</td>
          <td>${user.PASSWORD}</td>
        `;

        const actionsTd = document.createElement("td");

        // ❌ Update button removed

        const deleteBtn = document.createElement("button");
        deleteBtn.textContent = "Delete";
        deleteBtn.className = "delete-btn";
        deleteBtn.addEventListener("click", () =>
          deleteRow(deleteBtn, "users", user.USER_ID)
        );

        actionsTd.appendChild(deleteBtn);
        row.appendChild(actionsTd);
        tableBody.appendChild(row);
      });
    } else {
      tableBody.innerHTML = `<tr><td colspan="6">No data found</td></tr>`;
    }
  } catch (err) {
    tableBody.innerHTML = `<tr><td colspan="6">Error loading data</td></tr>`;
  }
}

// -------------------
// Default load
// -------------------
showTab("memberships");
