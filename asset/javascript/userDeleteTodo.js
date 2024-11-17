function showDeleteModal(taskId) {
  document.getElementById("listToDelete").value = taskId;
  document.getElementById("deleteModal").style.display = "block";
}

function closeDeleteModal() {
  document.getElementById("deleteModal").style.display = "none";
}

window.onclick = function (event) {
  var modal = document.getElementById("deleteModal");
  if (event.target == modal) {
    closeDeleteModal();
  }
};
