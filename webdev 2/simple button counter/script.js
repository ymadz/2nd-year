const number = document.querySelector(`.number`)
const button = document.querySelector(`.button`)
let count = 0;

button.addEventListener(`click`, e => {
   count++;
   number.textContent=count;
})
