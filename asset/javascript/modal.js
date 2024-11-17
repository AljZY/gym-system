const modal = document.getElementById("simpleModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeBtn = document.querySelector(".red-button");

openModalBtn.addEventListener("click", () => {
  modal.style.display = "block";
});

closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target == modal) {
    modal.style.display = "none";
  }
});
