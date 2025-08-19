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
function renderMultipleImages(files, container) {
    const previewContainer = document.querySelector(container);
    previewContainer.innerHTML = '';
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail me-2 mb-2';
            img.style.maxWidth = '150px';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
