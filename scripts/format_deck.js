// also have function to sort cards by alphabetical order in each category
function format_deck(data_source) {
    for (let i = 0; i < data_source.length; i++) {
        // https://www.w3schools.com/jsref/jsref_split.asp
        let text = data_source[i].type;
        let true_data_type;

        if (text.includes('—') === true) {
            const myArray = text.split("—");
            const newArray = myArray[0].split(" ");
            const arrayLength = newArray.length - 2;
            true_data_type = newArray[arrayLength];
        } else {
            const newArray = text.split(" ");
            const arrayLength = newArray.length - 1;
            true_data_type = newArray[arrayLength];
        }

        if (true_data_type.includes("Creature")) {
            creature_cards.push(data_source[i]);
        } else if (true_data_type.includes("Instant")) {
            instant_cards.push(data_source[i]);
        } else if (true_data_type.includes("Artifact")) {
            artifact_cards.push(data_source[i]);
        } else if (true_data_type.includes("Enchantment")) {
            enchantment_cards.push(data_source[i]);
        } else if (true_data_type.includes("Sorcery")) {
            sorcery_cards.push(data_source[i]);
        } else if (true_data_type.includes("Planeswalker")) {
            planeswalker_cards.push(data_source[i]);
        } else if (true_data_type.includes("Land")) {
            land_cards.push(data_source[i]);
        }
    }

    displayList(creature_cards, document.getElementsByClassName("creature")[0], creature_cards.length);
    displayList(instant_cards, document.getElementsByClassName("instant")[0], instant_cards.length);
    displayList(artifact_cards, document.getElementsByClassName("artifact")[0], artifact_cards.length);
    displayList(enchantment_cards, document.getElementsByClassName("enchantment")[0], enchantment_cards.length);
    displayList(sorcery_cards, document.getElementsByClassName("sorcery")[0], sorcery_cards.length);
    displayList(planeswalker_cards, document.getElementsByClassName("planeswalker")[0], planeswalker_cards.length);
    displayList(land_cards, document.getElementsByClassName("land")[0], land_cards.length);
}