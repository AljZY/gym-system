function showDeleteModal(id) {
  document.getElementById("AnnouncementNoToDelete").value = id;
  document.getElementById("deleteModal").style.display = "block";
}

function closeDeleteModal() {
  document.getElementById("deleteModal").style.display = "none";
}
