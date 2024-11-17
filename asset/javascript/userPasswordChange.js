function validatePassword() {
  const password = document.getElementById("new_password").value;
  const confirmPassword = document.getElementById("confirm_password").value;
  const errorMessage = document.querySelector(".error-message");

  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

  if (!password.match(passwordRegex)) {
    errorMessage.textContent =
      "Password must be at least 8 characters long, contain uppercase and lowercase letters, a number, and a symbol.";
    return false;
  }

  if (password === document.getElementsByName("current_password")[0].value) {
    errorMessage.textContent =
      "New password cannot be the same as the current password.";
    return false;
  }

  if (password !== confirmPassword) {
    errorMessage.textContent = "New passwords do not match.";
    return false;
  }

  return true;
}

function closeModal() {
  document.getElementById("successModal").style.display = "none";
  window.location.href = "../homepage.php";
}

window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("success")) {
    document.getElementById("successModal").style.display = "flex";
  }
};
