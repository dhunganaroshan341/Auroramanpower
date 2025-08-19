// Dropzone.autoDiscover = false;

// const sectionCategoryDropzone = new Dropzone("#sectionCategoryDropzone", {
//     url: '/admin/section-category/images/upload', // upload route
//     paramName: "file", // matches controller
//     maxFilesize: 5, // MB
//     acceptedFiles: "image/*",
//     addRemoveLinks: true,
//     dictRemoveFile: "×",
//     autoProcessQueue: false, // process when form submitted
//     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

//     init: function () {
//         const dz = this;

//         // Preload existing images if editing
//         if (window.existingImages) {
//             window.existingImages.forEach(image => {
//                 let mockFile = { name: image.name, size: image.size || 12345, dataURL: image.url, serverId: image.id };
//                 dz.emit("addedfile", mockFile);
//                 dz.emit("thumbnail", mockFile, image.url);
//                 dz.emit("complete", mockFile);
//             });
//         }

//         dz.on("removedfile", function(file) {
//             if (!file.serverId) return; // skip local files
//             $.ajax({
//                 url: '/section-category/images/delete/' + file.serverId,
//                 type: 'DELETE',
//                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                 success: function(response) {
//                     console.log('File deleted', response);
//                 },
//                 error: function(err) {
//                     console.error('Delete failed', err);
//                 }
//             });
//         });
//     }
// });
