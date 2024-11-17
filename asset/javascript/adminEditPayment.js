function updateAmount() {
  const selectedPlan = document.querySelector(
    'input[name="plan"]:checked'
  ).value;
  let amount = "";

  switch (selectedPlan) {
    case "1 day":
      amount = "30.00";
      break;
    case "1 week":
      amount = "100.00";
      break;
    case "1 month":
      amount = "200.00";
      break;
    case "3 months":
      amount = "500.00";
      break;
  }

  document.getElementById("amount-text").textContent = amount;
  document.getElementById("amount").value = amount;
}

window.onload = function () {
  const planRadios = document.querySelectorAll('input[name="plan"]');
  planRadios.forEach((radio) => {
    radio.addEventListener("change", updateAmount);
  });

  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("success")) {
    document.getElementById("successModal").style.display = "block";
  }
};
