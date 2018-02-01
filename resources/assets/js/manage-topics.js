let topicContainer = $('.profile .user-topics');
$.ajax({
    url: '/topic/user-topics',
    type: 'post',
    data: {user_id: topicContainer.parents('.profile').data('user-id')}
}).done(function (result) {
    setTopics(result.data, result.can_remove);
}).fail(function (jqXHR, textStatus, errorThrown) {
    console.log(errorThrown);
});

$(document).on('submit', '.profile form.add-topic', function (e) {
    e.preventDefault();
    $.ajax({
        url: '/topic',
        type: 'post',
        data: $(this).serialize(),
    }).done(function (result) {
        $('#topic-select').val(' ').trigger('change');
        let topics = result.data;
        setTopics(topics, true);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });;
});

$(document).on('submit', '.profile form.delete-form', function (e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'delete',
        data: form.serialize(),
    }).done(function (result) {
        if (result.status = 200) {
            $('.profile .user-topics').find('a[data-url="' + form.attr('action') + '"]').parent().remove();
            $('#delete-modal').modal('hide');
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
});


function setTopics(topics, canRemove) {
    let topicContainer = $('.profile .user-topics');
    topicContainer.children('.topic').remove();
    for (let i = 0; i < topics.length; i++) {
        let topic = $('<div class="topic"></div>');
        topic.append('<span>'+ topics[i].name +'</span>');
        if (canRemove) {
            topic.append('<a href="#delete-modal" data-toggle="modal" class="delete-btn" data-url="/topic/'+ topics[i].id +'"> <i class="fa fa-times" aria-hidden="true"></i></a>');
        }
        topicContainer.append(topic);
    }
}
