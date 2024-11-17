function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

if (getQueryParam("modal") === "1") {
  document.getElementById("myModal").style.display = "block";
}
