'use strict';
let Portal = (function($) {
    const _ = {};

    _.API_publicKey = "FLWPUBK-d644ae6cfc1171fc5184c75a84ceda3d-X";

    _.state  = function() {
    }

    _.make_payment = function(amount) {
        const that = this;
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
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect flwRef returned and pass to a
                that.transaction(response.tx)
                // console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
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

    _.transaction = function(txref) {
        $('#payment').attr('disabled', 'disabled');
        $('#payment').html('<i>please wait...</i>')
        const meta  = $('meta[name="csrf-token"]')

        $.ajax({
            url: '/payment',
            data: txref,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': meta.attr('content')
            }
        }).done(function(res) {
            console.log(res)
        }).error(function(err) {
            return alert(`Error Occured ${err}` )
        })
    };

    _.add_row = function(elem, html) {
        elem.append(html)
        return false
    };

    _.http = function(config) {

        const meta  = $('meta[name="csrf-token"]')

        if( ! config.hasOwnProperty('url') ) {
            return false
        }

        $.ajax({
            url: config.url,
            type: config.method,
            data: config.data,
            headers: {
                'X-CSRF-TOKEN': meta.attr('content')
            }
        }).then(function(resp) {
            return config.callback(resp)
        })
        .error(function(er) {
            return config.callback(er)
        })
    };



    return _
}(window.$));

window.Portal = Portal;