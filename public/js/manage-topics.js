/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

var topicContainer = $('.profile .user-topics');
$.ajax({
    url: '/topic/user-topics',
    type: 'post',
    data: { user_id: topicContainer.parents('.profile').data('user-id') }
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
        data: $(this).serialize()
    }).done(function (result) {
        $('#topic-select').val(' ').trigger('change');
        var topics = result.data;
        setTopics(topics, true);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });;
});

$(document).on('submit', '.profile form.delete-form', function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'delete',
        data: form.serialize()
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
    var topicContainer = $('.profile .user-topics');
    topicContainer.children('.topic').remove();
    for (var i = 0; i < topics.length; i++) {
        var topic = $('<div class="topic"></div>');
        topic.append('<span>' + topics[i].name + '</span>');
        if (canRemove) {
            topic.append('<a href="#delete-modal" data-toggle="modal" class="delete-btn" data-url="/topic/' + topics[i].id + '"> <i class="fa fa-times" aria-hidden="true"></i></a>');
        }
        topicContainer.append(topic);
    }
}

/***/ })

/******/ });