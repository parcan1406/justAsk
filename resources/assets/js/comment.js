registerEvents();

function registerEvents() {
    $(document).on('click', '.show-comments', function () {
        let commentable = $(this).closest('.commentable');
        if (!$.trim(commentable.find('.comments-container').html())) {
            loadCommentForm(commentable);
            loadComments(commentable);
        } else {
            commentable.find('.comments-container').slideToggle();
        }

    });

    $(document).on('click', '.commentable .add-comment', function () {
        let commentable = $(this).closest('.commentable');
        let commentForm = $(this).closest('.commentable.has-comment-form').find('form');
        commentForm.find('input[name="commentable_id"]').val(commentable.data('commentable-id'));
        commentForm.find('input[name="commentable_type"]').val(commentable.data('commentable-type'));
        commentForm.find('.reply-to').html('<label class="reply-label">Reply To:</label><span>' + commentable.find('.comment-user').html() + '</span><i class="fa fa-times cancel-reply" aria-hidden="true"></i>');


    });

    $(document).on('click', '.reply-to .cancel-reply', function () {
        let commentable = $(this).closest('.commentable.has-comment-form');
        let commentForm = $(this).closest('.commentable.has-comment-form').find('form');
        commentForm.find('input[name="commentable_id"]').val(commentable.data('commentable-id'));
        commentForm.find('input[name="commentable_type"]').val(commentable.data('commentable-type'));
        commentForm.find('.reply-to').html('');

    });

    $(document).on('submit', '.commentable .comment-form', function (e) {
        e.preventDefault();
        let commentForm = $(this);

        $.ajax({
            url: '/comment',
            type: 'POST',
            data: commentForm.serialize()
        }).done(function (result) {
            commentForm.find('input[name="content"]').val('');
            try {
                let comment = result.data;
                let commentable = commentForm.closest('.commentable');

                let parent = (commentable.data('commentable-id') == comment.commentable_id && commentable.data('commentable-type') == comment.commentable_type)
                    ? commentable : commentable.find('[data-commentable-id=' + comment.commentable_id + ']');
                parent = parent.find('.comments-container').first();
                console.log(parent.length);
                if (parent.find('.comments ul').length == 0) {
                    parent.children('.comments').append('<ul class="list-group"></ul>');
                }
                parent.children('.comments').children('ul').append(createCommentElement(comment));
            } catch (err) {
                console.log(err.message);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        });
    });
}

function getComments(comments) {
    if (comments.length == 0) return '';
    let comments_container = $('<ul class="list-group"></ul>');
    for (let i = 0; i < comments.length; i++) {
        let comment_element = createCommentElement(comments[i]);
        comments_container.append(comment_element);
    }

    return comments_container;
}

function loadCommentForm(commentable) {
    let commentForm = $('<form class="comment-form" ></form>');
    commentForm.append('<input type="hidden" name="commentable_id" value=' + commentable.data('commentable-id') + '>');
    commentForm.append('<input type="hidden" name="commentable_type" value=' + commentable.data('commentable-type') + '>');
    commentForm.append('<div class="form-group"><div class="reply-to"></div> ' +
        '<input name="content" class="form-control comment-field" placeholder="Add Comment..." required /></div>');
    commentForm.append('<button type="submit" class="btn btn-success submit-comment">Submit</button>');

    let form_container = $('<div class="add-comment-form"></div>');
    form_container.append(commentForm);

    commentable.find('.comments-container').append(form_container);
}

function loadComments(commentable) {

    commentable.find('.comments-container').append('<div class="comments"></div>');
    $.ajax({
        url: '/comment',
        type: 'GET',
        data: {
            'commentable_id': commentable.data('commentable-id'),
            'commentable_type': commentable.data('commentable-type')
        }
    }).done(function (result) {
        if (result.data.length) {
            try {
                commentable.find('.comments-container .comments').append(getComments(result.data));
            } catch (err) {
                console.log(err.message);
            }
        }

    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}

function createCommentElement(comment) {
    let comment_element = $('<li class="list-group-item comment commentable"' +
        'data-commentable-id="' + comment.id + '"' +
        'data-commentable-type="App\\Comment"></li>');

    let comment_head = $('<div class="comment-head"></div>');
    if (comment.user.profile_avatar) {
        comment_head.append('<img class="profile-image-small img-circle" src="/storage/'+ comment.user.profile_avatar +'">');
    } else {
        comment_head.append('<img class="profile-image-small img-circle" src="/images/profile-image.png">');
    }
    comment_head.append('<span class="comment-user">' + comment.user.name + '</span>');
    comment_head.append('<span class="comment-date">' + comment.updated_at + '</span>');
    comment_head.append('<i class="fa fa-comment add-comment" aria-hidden="true"></i>');

    let comment_content = $('<div class="comment-content">' + comment.content + '</div>');

    let child_container = $('<div class="comments-container"></div>');
    child_container.append('<div class="comments"></div>');
    let child_comments = getComments(comment.comments);
    child_container.children('.comments').append(child_comments);
    comment_element.append(comment_head);
    comment_element.append(comment_content);
    comment_element.append(child_container);

    return comment_element;
}





