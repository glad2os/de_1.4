const checkBox = document.getElementById("flexCheckDefault");
const fioControl = document.getElementById("exampleFormControlTextarea1");
const loginControl = document.getElementById("loginControl");
const emailControl = document.getElementById("emailControl");
const passControl = document.getElementById("passControl");
const pass2Control = document.getElementById("pass2Control");

checkBox.addEventListener('click', function (event) {
    if (fioControl.value.length < 3) {
        fioControl.focus()
        alert("ФИО отсутствует");
        event.preventDefault();
        return;
    }
    if (loginControl.value.length < 3) {
        loginControl.focus()
        alert("Логин отсутствует");
        event.preventDefault();
        return;
    }
    if (emailControl.value.length < 3) {
        emailControl.focus()
        alert("Email отсутствует");
        event.preventDefault();
        return;
    }
    if (passControl.value.length < 3) {
        passControl.focus()
        alert("Пароль отсутствует");
        event.preventDefault();
        return;
    }

    if (!(passControl.value === pass2Control.value)) {
        pass2Control.focus()
        alert("Пароли не совпадают");
        event.preventDefault();
        return;
    }

    request('api/user/signUp.php', {
        "fio": fioControl.value,
        "login": loginControl.value,
        "email": emailControl.value,
        "passwd": passControl.value
    }, () => {
        location.reload();
    });

}, false);