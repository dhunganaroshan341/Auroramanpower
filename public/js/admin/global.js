// public/js/global.js
function renderImage(response, containerSelector, imageKey = 'image', defaultImage = '/user.png', width = 100, height = 100) {
    let imagePath = '';

    if (typeof response === 'string') {
        imagePath = response;
    } else if (response && response[imageKey]) {
        imagePath = response[imageKey];
    }

    const html = `<img src="${imagePath ?   imagePath :  defaultImage}"
                       alt="Image"
                       width="${width}"
                       height="${height}"
                       onerror="this.onerror=null;this.src='${defaultImage}';">`;

    $(containerSelector).html(html);
}
