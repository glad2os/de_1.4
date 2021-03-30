const checkBox = document.getElementById("flexCheckDefault");
const loginControl = document.getElementById("loginControl");
const passControl = document.getElementById("passControl");

checkBox.addEventListener('click', function (event) {
    if (loginControl.value.length < 3) {
        loginControl.focus()
        alert("Логин отсутствует");
        event.preventDefault();
        return;
    }
    if (passControl.value.length < 3) {
        passControl.focus()
        alert("Пароль отсутствует");
        event.preventDefault();
        return;
    }

    console.log("done!");
}, false);