let modal = document.getElementById("card_modal");
let btn = document.getElementById("myBtn");
let span = document.getElementById("close");

function modal_config(index) {
    let modal_text = document.getElementById("modal_text");
    let modal_body = document.getElementById("modal_body");
    modal_body.innerHTML = "";

    let modal_image = document.createElement("img");
    let modal_text_body = document.createElement("ul");
    let modal_description = document.createElement("li");
    let modal_cmc = document.createElement("li");
    let modal_rarity = document.createElement("li");
    let modal_flavor = document.createElement("li");
    let modal_button = document.createElement("button");

    modal_text.innerText = data_source[index]['name'] + " (" + data_source[index]['card_set'] + ")";

    modal_image.src = data_source[index]['imageUrl'];

    modal_cmc.innerHTML = "<span>Converted Mana Cost:</span> " + data_source[index]['cmc'];
    modal_rarity.innerHTML = "<span>Card Rarity:</span> " + data_source[index]['rarity'];
    modal_description.innerText = data_source[index]['text'];
    modal_flavor.innerHTML = (data_source[index]['flavor']) ? "<i>" + data_source[index]['flavor'] + "</i>" :
        "<span>No Flavor Text</span>";
    modal_button.innerText = "Remove from Deck";
    modal_button.setAttribute("onclick", "remove_from_deck(" + data_source[index]['auto_id'] + ")");
    modal_button.classList.add("modal_button");

    modal_text_body.appendChild(modal_cmc);
    modal_text_body.appendChild(modal_rarity);
    modal_text_body.appendChild(modal_description);
    modal_text_body.appendChild(modal_flavor);
    modal_text_body.appendChild(modal_button);
    modal_body.appendChild(modal_image);
    modal_body.appendChild(modal_text_body);
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}