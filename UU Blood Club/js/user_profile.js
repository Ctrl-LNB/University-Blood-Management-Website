// // Function to fetch user data and populate the form
// async function loadUserProfile(userId) {
//     try {
//         // Fetch data from PHP
//         const response = await fetch(`php/get_user.php?USER_ID=${userId}`);
//         const result = await response.json();

//         if (result.status === "success") {
//             const user = result.data;

//             // Set form fields
//             document.getElementById("name").value = user.NAME || "";
//             document.getElementById("varsity_id").value = user.USER_ID || "";
//             document.getElementById("email").value = user.EMAIL || "";
//             document.getElementById("occupation").value = user.OCCUPATION || "Student";
//             document.getElementById("last_donation").value = user.LAST_DONATION_DATE || "";
//         } else {
//             alert(result.message || "Failed to load user data");
//         }
//     } catch (error) {
//         console.error("Error fetching user data:", error);
//         alert("Error loading user profile");
//     }
// }

// // Example: Load user profile for user ID 5
// // Replace 5 with the actual user ID, e.g., from session
// document.addEventListener("DOMContentLoaded", () => {
//     const currentUserId = 5; 
//     loadUserProfile(currentUserId);
// });
