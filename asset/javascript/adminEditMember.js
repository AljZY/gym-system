document.getElementById("successModal").style.display = "block";

function closeSuccessModal() {
  document.getElementById("successModal").style.display = "none";
}

function removeSuccessParam() {
  if (window.history.replaceState) {
    const url = new URL(window.location);
    url.searchParams.delete("success");
    window.history.replaceState({ path: url.toString() }, "", url.toString());
  }
}

removeSuccessParam();
