function showDeleteModal(itemNo) {
  document.getElementById("itemNoToDelete").value = itemNo;
  document.getElementById("deleteModal").style.display = "block";
}

function closeDeleteModal() {
  document.getElementById("deleteModal").style.display = "none";
}
