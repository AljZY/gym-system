var deleteModal = document.getElementById("deleteModal");
var confirmDeleteButton = document.getElementById("confirmDeleteButton");
var memberIdToDelete = null;

function openModal(memberName, memberId) {
  memberIdToDelete = memberId;
  document.getElementById("modalMessage").innerText =
    "Are you sure you want to delete " + memberName + "?";
  deleteModal.style.display = "block";
}

function closeModal() {
  deleteModal.style.display = "none";
  memberIdToDelete = null;
}

confirmDeleteButton.addEventListener("click", function () {
  if (memberIdToDelete !== null) {
    window.location.href =
      "../../../php/admin/member/deleteMember.php?id=" + memberIdToDelete;
  }
});
