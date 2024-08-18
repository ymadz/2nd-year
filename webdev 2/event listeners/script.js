const grandparent = document.querySelector(`.grandparent`);
const parent = document.querySelector(`.parent`);
const child = document.querySelector(`.child`);

grandparent.addEventListener(`click`, e => {
    grandparent.append("hello world")
})

parent.addEventListener(`click`, e => {
    grandparent.append("hello world")
})

child.addEventListener(`click`, e => {
    grandparent.append("hello world")
})


