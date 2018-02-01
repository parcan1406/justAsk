$('#topic-select').select2({
    width: '50%',
    placeholder: 'Select a topic'
});

$(document).on('click', 'button.add-answer', function () {
    $('.add-answer-field').slideToggle();
});

$('.answer-content .edit-value').editable({
    'property': 'content',
    'required': true,
    'afterSubmit': function (result) {
        let editDate = this.parents('.answer').find('.edit-date');
        if (result.updated_at) {
            editDate.html(result.updated_at);
        }
    }
});