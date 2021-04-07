const checkBox = document.getElementById('flexCheckDefault');
const building_address = document.getElementById('building_address');
const description = document.getElementById('description');
const max_price = document.getElementById('max_price');

checkBox.addEventListener('click', function (event) {
    if (building_address.value.length < 3) {
        building_address.focus();
        alert("Адрес не заполнен");
        event.preventDefault();
        return;
    }

    if (description.value.length < 3) {
        description.focus();
        alert("Описание не заполнено");
        event.preventDefault();
        return;
    }

    if (category.value.length < 1) {
        category.focus();
        alert("Категория не выбрана")
        event.preventDefault();
        return;
    }

    if (Number(max_price.value) < 1) {
        category.focus();
        alert("Сумма не может быть меньше 1")
        event.preventDefault();
        return;
    }

    sendFile();
}, false);

function sendFile() {
    let formData = new FormData;
    formData.append('file', document.getElementById('formFile').files[0]);
    formData.append('building_address', building_address.value);
    formData.append('description', description.value);
    formData.append('category', category.value);
    formData.append('max_price', Number(max_price.value));

    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/api/ticket/create_ticket.php', true);
    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                alert(this.response);
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