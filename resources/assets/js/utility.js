$(function(){
    $('#add-school').on('click', function(e) {
        const elem = $('.add-row')
        let html   = ` <div class="col-md-6">
                <label for="">Name of School Attended</label>
                <input type="text" class="form-control" >
            </div>`
        html += `<div class="col-md-3">
                    <label for="">From </label>
                    <input type="text" class="form-control" placeholder="MM/YYYY">
                </div>`
        html += `<div class="col-md-3">
                    <label for="">To</label>
                    <input type="text" class="form-control" placeholder="MM/YYYY">
                </div>`
        return Portal.add_row(elem, html);
    })

    $('#ajax-form').on('submit', function(e) {
        e.preventDefault();
        const data      = $(this).serialize()
        const url       = $(this).attr('action')
        const method    = $(this).attr('method')

        return Portal.http({
            url: url,
            method: method,
            data: data,
            callback: function(resp) {
                console.log(resp)
            }
        })
    })

    $('.course-selection').on('change', function() {
        let elem = $(this)
        let total_unit = $('#total-unit')
        for(let el = 0; el < elem.length; el++) {
            let unit = $(this).val().split('-')

            if( elem[el].checked) {
                total_unit.text( parseInt(total_unit.text()) + parseInt(unit[1]))
            } else {
                console.log('unchecked')
                total_unit.text( parseInt(total_unit.text()) - parseInt(unit[1]))
            }
        }
    })

    // $('#submit-courses').on('submit', function() {
    //     const data = $('.course-selection')
    // })

})