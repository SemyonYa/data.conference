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

function publishing() {
    let photos = [];
    $('.unpublished-photo').each(function () {
        photos.push($(this).data('id'));
    });
    console.log(photos);
    $('#publish-button').prop('disabled', true);
    $('#publish-button').html('Выбранные фото публикуются... <span class="glyphicon glyphicon-time"></span>');
    $.ajax({
        method: 'POST',
        url: '/photo/publish-checked',
        data: {
            ids: photos
        }
    }).done((resp) => {
        if (resp) {
            window.location.href = '/photo/published';
        }
    })
}