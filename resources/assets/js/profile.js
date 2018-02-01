$(document).on('mouseenter mouseleave', '.profile-header .profile-avatar', function () {
    let changeAvatar = $(this).find('.change-avatar');
    changeAvatar.slideToggle(200);

});

$(document).on('click', '.profile-header .profile-avatar', function () {
    $(this).parents('.profile-header').find('form input[type=file]').click();
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.profile-avatar .profile-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#avatar-file").change(function() {
    readURL(this);
});

$('.profile .edit-value#username').editable({
    'placeholder': 'Set Name',
    'property': 'name',
    'required': true,
});

$('.profile .edit-value#email').editable({
    'placeholder': 'Set Email',
    'property': 'email',
    'required': true
});

$('.profile .edit-value#add-info').editable({
    'placeholder': '(Add info)',
    'property': 'add_info',
});

$('.profile #topic-select').select2({
    width: '50%',
    placeholder: 'Select topics...',
});

