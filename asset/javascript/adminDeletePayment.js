function showModal(paymentId) {
  document.getElementById("confirmDelete").setAttribute("data-id", paymentId);
  document.getElementById("deleteModal").style.display = "block";
}

function hideModal() {
  document.getElementById("deleteModal").style.display = "none";
}

function confirmDelete() {
  const paymentId = document
    .getElementById("confirmDelete")
    .getAttribute("data-id");
  window.location.href =
    "../../../php/admin/payment/deletePayment.php?id=" + paymentId;
}
