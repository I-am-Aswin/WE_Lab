
function handleclick(event) {

    let key = event.target.value;
    let display = document.getElementById("display")
    let value = display.innerHTML;

    if( Number(key) || key === "0" ) {
        display.innerHTML += key;
    } else {
        if( Number(value.slice(-1)) || value.slice(-1) === "0" ) {
            display.innerHTML += key;
        } else {
            display.innerHTML = value.slice(0,-1) + key;
        }
    }
}

document.getElementById("btn-erase").addEventListener('click', () => {
    let display = document.getElementById("display");
    let value = display.innerHTML;

    if( value.length > 0 ) {
        display.innerHTML = value.slice(0, -1);
    }
});

document.getElementById("btn-enter").addEventListener('click', () => {
    let display = document.getElementById("display");
    let value = display.innerHTML;

    display.innerHTML = eval(value);
});