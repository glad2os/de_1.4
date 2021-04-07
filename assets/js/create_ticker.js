const checkBox = document.getElementById('flexCheckDefault');
checkBox.addEventListener('click', function (event) {
    event.preventDefault();

    sendFile();
}, false);

function sendFile() {
    let formData = new FormData;
    formData.append('file', document.getElementById('formFile').files[0]);
    formData.append("весь ядерный потенциал мне куда?", "мне в попу");
    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/api/ticket/create_ticket.php', true);
    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {

            }
            if (this.status === 400) {
                alert(JSON.parse(this.response).error);
            }
            if (this.status === 403) {
                alert(JSON.parse(this.response).error);
                window.location = "/";
            }
        }
    }
}