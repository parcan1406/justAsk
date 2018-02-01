let Editable = function (elem, settings) {
    this.init(elem, settings);
    this.registerEvents();

};


Editable.prototype.init = function (elem, settings) {
    this.settings = settings;
    this.elem = elem;
    this.container = elem.wrap('<div class="edit-container"></div>').parent();
    this.editBtn = $('<a href="#" class="edit-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>');
    this.placeholder = $('<span class="edit-placeholder"><a href="#" class="edit-empty-btn">'+ this.settings.placeholder +'</a></span>');
    this.errors = $('<div class="edit-errors"></div>');
    this.container.append(this.placeholder);
    this.container.append(this.editBtn);



    if (!$.trim (this.elem.text())) {
        this.elem.hide();
        this.editBtn.hide();
        this.placeholder.show();
    } else {
        this.placeholder.hide();
    }

};

Editable.prototype.registerEvents = function () {
    let self = this;

    self.container.on('click', '.edit-btn', function (e) {
        e.preventDefault();
        self.elem.hide();
        self.editBtn.hide();
        self.createForm();


    });

    self.container.on('click', '.edit-empty-btn', function (e) {
        e.preventDefault();
        self.placeholder.hide();
        self.createForm();
    });

    self.container.on('click', '.edit-cancel', function (e) {
        e.preventDefault();
        self.removeForm();
    });

    self.container.on('click', '.edit-submit', function (e) {
        e.preventDefault();
        self.submitForm();
    });
};

Editable.prototype.createForm = function () {
    let form = $('<form class="edit-form"></form>');
    form.append('<textarea class="edit-text form-control"'+ (this.settings.required ? 'required' : '') +'  name="'+ this.settings.property +'">' + this.elem.text() + '</textarea>');
    form.append('<button class="btn btn-primary edit-submit">Update</button>');
    form.append('<button class="btn btn-default edit-cancel">Cancel</button>');
    this.container.append(form);
};

Editable.prototype.removeForm = function () {
    this.container.children('.edit-form').remove();

    if (!$.trim (this.elem.text())) {
        this.placeholder.show();
    } else {
        this.elem.show();
        this.editBtn.show();
    }

};


Editable.prototype.submitForm = function () {
    let self = this;
    let form = self.container.children('.edit-form');
    form.children('.edit-error').remove();

    $.ajax({
        url: self.elem.data('edit-url'),
        type: 'put',
        data: form.serialize()
    }).done(function (result) {
        self.elem.html(result.content);
        self.removeForm();
        self.settings.afterSubmit.call(self.elem, result);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status == 422) {
            let response = JSON.parse(jqXHR.responseText);
            if (response.errors[self.settings.property]) {
                form.children('textarea').after('<span class="edit-error">' + response.errors[self.settings.property][0] +'</span>');
            }
        } else {
            console.log(errorThrown);
        }


    });

};


$.fn.editable = function(options) {

    let settings = $.extend({
        placeholder: 'Set value',
        required: false,
        afterSubmit: function () {}
    }, options );

    this.each(function () {
       new Editable($(this), settings);
    });
    return this;


};


