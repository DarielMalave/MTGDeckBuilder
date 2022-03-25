function lazy_loading(image) {
    if (image.complete) {
        image.classList.remove('lazy_load');
        image.classList.add('fade_in');
    }
}