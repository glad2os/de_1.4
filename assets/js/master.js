document.getElementById('addCat').addEventListener('click', ev => {
    let value = ev.target.parentElement.children[0].value;

    request('api/master/addCategory.php', {
        "category": value,
        'action': "add"
    }, (item) => {
        alert(item);
    }, () => {
    });
    ev.target.parentElement.children[0].value = "";
})

document.getElementById('removeCat').addEventListener('click', ev => {
    let value = document.getElementById('category').value;

    request('api/master/addCategory.php', {
        "category": value,
        'action': "remove"
    }, (item) => {
        alert(item);
        location.reload();
    }, () => {
    });

})

