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
    $('.unpublished-photo:checked').each(function () {
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

function roleOn(e) {
    $('.people-list').addClass('disabled');
    const roleId = $(e.target).attr('data-id');
    console.log("roleOn -> roleId", roleId)
    $('#people-list-' + roleId).removeClass('disabled');
    $('.people-menu-item').removeClass('people-menu-item-active');
    $(e.target).addClass('people-menu-item-active');
}

function showPerson(id) {
    $('#ConferenceFrontModalContent').load('/front/person-modal?id=' + id);
}

function showSchedulePresentations(scheduleId) {
    $('#ConferenceFrontModalContent').load('/front/schedule-presentation-modal?schedule_id=' + scheduleId);
}

function saveMark(presentationId) {
    // debounce(() => {
    //     console.log('qwe');
    // }, 1000, false);
    const rating = $('input.front-presentation-rating-level:checked').val();
    const description = $('#front-mark-description').val();
    $.ajax({
        method: 'POST',
        url: '/front/set-mark',
        data: { rating, description, presentationId}
    }).done((resp) => {
        console.log('resp', resp);
    });
    console.log('rating', rating);
    console.log('description', description);
}

// function debounce(func, wait, immediate) {
//     var timeout;
//     return function() {
//         var context = this, args = arguments;
//         var later = function() {
//             timeout = null;
//             if (!immediate) func.apply(context, args);
//         };
//         var callNow = immediate && !timeout;
//         clearTimeout(timeout);
//         timeout = setTimeout(later, wait);
//         if (callNow) func.apply(context, args);
//     };
// }

/*
    GALERY
*/
function showPhoto(id) {
    $('.front-backdrop').css('display', 'block');
    $('.front-photo-opened-wrap').css('display', 'flex');
    loadPhoto(id);
}
function loadPhoto(id) {
    $.ajax({
        method: 'GET',
        url: '/front/get-photo-path?id=' + id
    }).done((path) => {
        $('#front-lightbox-photo').attr('src', path);
        $('#front-lightbox-photo').attr('data-id', id);
    });
}
function closeLightbox() {
    $('.front-backdrop').css('display', 'none');
    $('.front-photo-opened-wrap').css('display', 'none');
}

function nextPhoto(direction) {
    const currentId = $('#front-lightbox-photo').attr('data-id');
    console.log("nextPhoto -> $('#front-lightbox-photo')", $('#front-lightbox-photo'))
    console.log("nextPhoto -> currentId", currentId)
    let count = 0;
    $('.front-photo').each((n, el) => {
        count++;
    });
    let currentNo = $('.front-photo[data-id=' + currentId + ']').data('no');
    if (direction === 'next') {
        if (currentNo < count) {
            const nextNo = currentNo + 1;
            const nextId = $('.front-photo[data-no=' + nextNo + ']').data('id');
            loadPhoto(nextId);
        }
    } else if (direction === 'prev') {
        if (currentNo > 1) {
            const nextNo = currentNo - 1;
            const nextId = $('.front-photo[data-no=' + nextNo + ']').data('id');
            loadPhoto(nextId);
        }
    }
}

function like(e) {
    const photoId = $(e.target).attr('data-id');
    $.ajax({
        method: 'GET',
        url: '/front/like?photo_id=' + photoId
    }).done((resp) => {
        const data = JSON.parse(resp);
        if (data['on']) {
            $(e.target).addClass('front-like-on glyphicon-heart');
            $(e.target).removeClass('glyphicon-heart-empty');
            $(e.target).text(data['count']);
        } else {
            $(e.target).removeClass('front-like-on glyphicon-heart');
            $(e.target).addClass('glyphicon-heart-empty');
            $(e.target).text('');
        }
    });
    // console.log("like -> e.target", e.target)
}