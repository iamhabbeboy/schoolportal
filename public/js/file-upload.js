$(function() {
    const elem = $('#profile')
    elem.click(function() {
        const photo = $('#photo').click();
    })

    $('#photo').on('change', function() {
        $('#profile-ajax').html('<i>please wait...</i>')
        $('#ajaxData').ajaxForm({
            target: '#profile-ajax'
        }).submit()
    });

})