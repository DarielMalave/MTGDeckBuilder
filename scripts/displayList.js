function displayList(data_source, wrapper, rows_per_page, page) {
    wrapper.innerHTML = "";

    if (data_source.length === 0) {
        //console.log("empty object here");
        let error_element = document.createElement('p');
        error_element.innerText = "No results returned.";
        wrapper.appendChild(error_element);
        return;
    }

    if (typeof(data_source) !== 'object') {
        let error_element = document.createElement('p');
        error_element.innerText = "No results returned. Please check if query is valid.";
        wrapper.appendChild(error_element);
        return;
    }

    // account for cases where page does have cards but not up to
    // rows_per_page
    for (let i = 0; i < rows_per_page; i++) {
        let card_element = document.createElement('div');
        let card_image = document.createElement('img');

        card_image.src = data_source[i]['imageUrl'];
        card_image.classList.add('lazy_load');
        card_image.setAttribute("index", i);
        card_image.setAttribute("onclick", "modal_config(" + i + ")");
        card_image.setAttribute("onload", "lazy_loading(this)");

        card_element.appendChild(card_image);
        wrapper.appendChild(card_element);
    }
}