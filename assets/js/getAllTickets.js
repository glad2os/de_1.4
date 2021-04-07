const ticketPlace = document.querySelector('.tickets');

request('api/ticket/get_all_tickets.php', {}, (item) => {
        item.forEach((value) => {
            let itemdiv = document.createElement("div");
            itemdiv.classList.add('item');

            let ticket_id = document.createElement('div');
            ticket_id.classList.add('p');
            ticket_id.innerText = "Номер заявки:" + value['ticket_id'];

            let building_address = document.createElement('div');
            building_address.classList.add('p');
            building_address.innerText = "Адрес: " + value['building_address'];

            let description = document.createElement('div');
            description.classList.add('p');
            description.innerText = "Описание: " + value['description'];


            let category = document.createElement('div');
            category.classList.add('p');
            category.innerText = "Категория: " + value['category'];

            let img = document.createElement('img');
            img.src = value['img_path'];

            let time = document.createElement('div');
            time.classList.add('time');
            time.innerText = value['time'];

            let button = document.createElement('button');
            button.classList.add('btn');
            button.classList.add('btn-danger');
            button.type = "button";
            button.innerText = "Удалить";

            itemdiv.appendChild(ticket_id);
            itemdiv.appendChild(building_address);
            itemdiv.appendChild(description);
            itemdiv.appendChild(category);
            itemdiv.appendChild(img);
            itemdiv.appendChild(time);
            itemdiv.appendChild(button);

            ticketPlace.appendChild(itemdiv);
        });

    },
    () => {

    });