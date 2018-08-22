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
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var Portal = function ($) {
    var _ = {};

    _.API_publicKey = "FLWPUBK-d644ae6cfc1171fc5184c75a84ceda3d-X";

    _.state = function () {};

    _.make_payment = function (amount) {
        var that = this;
        var x = getpaidSetup({
            PBFPubKey: that.API_publicKey,
            customer_email: "abiodun.solomon.a@example.com",
            amount: amount,
            customer_phone: "234099940409",
            currency: "NGN",
            payment_method: "both",
            txref: "rave-123456",
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function onclose() {},
            callback: function callback(response) {
                var txref = response.tx.txRef; // collect flwRef returned and pass to a
                that.transaction(response.tx);
                // console.log("This is the response returned after a charge", response);
                if (response.tx.chargeResponseCode == "00" || response.tx.chargeResponseCode == "0") {
                    // redirect to a success page
                    window.location = '/form?rel=1';
                } else {
                    // redirect to a failure page.
                    window.location = '/form?rel=0';
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    };

    _.transaction = function (txref) {
        $('#payment').attr('disabled', 'disabled');
        $('#payment').html('<i>please wait...</i>');
        var meta = $('meta[name="csrf-token"]');

        $.ajax({
            url: '/payment',
            data: txref,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': meta.attr('content')
            }
        }).done(function (res) {
            console.log(res);
        }).error(function (err) {
            return alert("Error Occured " + err);
        });
    };

    _.add_row = function (elem, html) {
        elem.append(html);
        return false;
    };

    _.http = function (config) {

        var meta = $('meta[name="csrf-token"]');

        if (!config.hasOwnProperty('url')) {
            return false;
        }

        $.ajax({
            url: config.url,
            type: config.method,
            data: config.data,
            headers: {
                'X-CSRF-TOKEN': meta.attr('content')
            }
        }).then(function (resp) {
            return config.callback(resp);
        }).error(function (er) {
            return config.callback(er);
        });
    };

    return _;
}(window.$);

window.Portal = Portal;

/***/ }),

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(2);


/***/ })

/******/ });