function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get("modal") === "1") {
  document.getElementById("myModal").style.display = "block";
}
