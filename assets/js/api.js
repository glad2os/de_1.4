function nop() {
}

function request(target, body, callback = nop, fallbackCallback = function (resp) {
    alert(resp['error']);
}) {
    const request = new XMLHttpRequest();
    request.open("POST", `/${target}`, true);
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.responseType = "json";
    request.onreadystatechange = () => {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) callback(request.response);
            if (request.status === 204) callback(request.response);
            else fallbackCallback(request.response);
        }
    };
    request.send(JSON.stringify(body));
}
