// ===============================
// ✅ SIGN UP FUNCTION
// ===============================

const getData = async () => {
  const res = await fetch('php/find_donor.php');
  const json = await res.json();
  return json;
}

async function signUp() {
    const email = document.getElementById("signup_email").value.trim();
    const password = document.getElementById("signup_password").value.trim();

    // const user = await getData();
    // console.log(user);

    // const foundUser = user.find(element => element.EMAIL === email);
    // console.log(foundUser);




    // Basic Validation
    if (email === "" || password === "") {
        alert("⚠️ All fields are required!");
        return;
    }

    if (!validateEmail(email)) {
        alert("⚠️ Invalid email format!");
        return;
    }

    const userData = { email, password };

    let response = await fetch("insert_user.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(userData)
    });

    let result = await response.json();
    alert(result.message);

    if (result.status === "success") {
        // Clear fields
        document.getElementById("signup_email").value = "";
        document.getElementById("signup_password").value = "";
    }
}

// ===============================
// ✅ SIGN IN FUNCTION
// ===============================
async function signIn() {
    const email = document.getElementById("signin_email").value.trim();
    const password = document.getElementById("signin_password").value.trim();

    // Basic validation
    if (!email || !password) {
        alert("⚠️ Please enter both email and password!");
        return;
    }

    if (!validateEmail(email)) {
        alert("⚠️ Invalid email format!");
        return;
    }

    const loginData = { email, password };

    try {
        const response = await fetch("login_user.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(loginData)
        });

        // Check if response is ok
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();

        if (result.status === "success") {
            alert(result.message);
            window.location.href = "user_profile.php";
        } else {
            alert(result.message); 
        }

    } catch (error) {
        console.error("Login error:", error);
        alert("⚠️ Something went wrong while trying to login. Please try again.");
    }
}

// Optional: email format validator
function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Event listener
document.getElementById("signin_btn")?.addEventListener("click", (e) => {
    e.preventDefault();
    signIn();
});


// ===============================
// 📌 EMAIL VALIDATOR
// ===============================
function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// ===============================
// 📌 EVENT LISTENERS
// ===============================

document.getElementById("signup_btn")?.addEventListener("click", (e) => {
    e.preventDefault();
    signUp();
});

document.getElementById("loginForm")?.addEventListener("submit", (e) => {
    e.preventDefault();
    signIn();
});
