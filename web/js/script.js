///
// ImageManager
///
function LoadImageManager(attr) {
    $('#ConferenceModal').load('/image/list-modal');
    $('#ConferenceModal').attr('data-input-id', attr);
}

function ChooseImage(name) {
    $('#' + $('#ConferenceModal').attr('data-input-id')).val(name);
    $('#ConferenceImgPreview').attr('src', '/web/images/' + name);
    $('#ConferenceModal').modal('hide');
}