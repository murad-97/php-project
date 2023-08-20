let button = document.querySelectorAll(".pro");
let section = document.querySelectorAll(".section");
let info = document.querySelector(".profile-sec");
let order = document.querySelector(".orders");
console.log(button);
button[0].style = "border-bottom: 2px solid #8cdadf;";
button.forEach((ele) => {
  ele.addEventListener("click", (eo) => {
    section.forEach((element) => {
      element.style.display = "none";
    });
    button.forEach((ele) => {
      ele.style = "border-bottom:none;";
    });
    ele.style = "border-bottom: 2px solid #8cdadf;";
    if (ele.textContent === "info") {
      info.style.display = "flex";
    } else if (ele.textContent === "payment & order") {
      order.style.display = "block";
    }
  });
});
