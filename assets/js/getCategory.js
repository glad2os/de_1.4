
const category = document.getElementById('category');

const xhr = new XMLHttpRequest();
xhr.open("POST", '/api/ticket/get_all_category.php', true);
xhr.send(null);
xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            let responce = JSON.parse(this.response);
            responce.forEach((value) => {
                let child = document.createElement("option");
                child.innerText = value[1];
                category.appendChild(child);
            });
        }
        if (this.status === 400) {
            alert(JSON.parse(this.response).error);
        }
        if (this.status === 403) {
            alert(JSON.parse(this.response).error);
        }
    }
}