var modal = document.getElementById("successModal");

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has("success")) {
  modal.style.display = "block";
}

function redirectToMembers() {
  window.location.href = "members.php";
}

function closeModal() {
  modal.style.display = "none";
  window.location.href = window.location.pathname;
}

window.onclick = function (event) {
  if (event.target == modal) {
    closeModal();
  }
};
