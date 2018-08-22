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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, exports) {

$(function () {
    $('#add-school').on('click', function (e) {
        var elem = $('.add-row');
        var html = ' <div class="col-md-6">\n                <label for="">Name of School Attended</label>\n                <input type="text" class="form-control" >\n            </div>';
        html += '<div class="col-md-3">\n                    <label for="">From </label>\n                    <input type="text" class="form-control" placeholder="MM/YYYY">\n                </div>';
        html += '<div class="col-md-3">\n                    <label for="">To</label>\n                    <input type="text" class="form-control" placeholder="MM/YYYY">\n                </div>';
        return Portal.add_row(elem, html);
    });

    $('#ajax-form').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var method = $(this).attr('method');

        return Portal.http({
            url: url,
            method: method,
            data: data,
            callback: function callback(resp) {
                console.log(resp);
            }
        });
    });

    $('.course-selection').on('change', function () {
        var elem = $(this);
        var total_unit = $('#total-unit');
        for (var el = 0; el < elem.length; el++) {
            var unit = $(this).val().split('-');

            if (elem[el].checked) {
                total_unit.text(parseInt(total_unit.text()) + parseInt(unit[1]));
            } else {
                console.log('unchecked');
                total_unit.text(parseInt(total_unit.text()) - parseInt(unit[1]));
            }
        }
    });

    // $('#submit-courses').on('submit', function() {
    //     const data = $('.course-selection')
    // })
});

/***/ })

/******/ });