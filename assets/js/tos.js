$(document).ready(function () {
    $('#reg').click(function (e) {
        if ($('#TOS').not(':checked').length) {
            e.preventDefault();
            alert('You must agree with terms of service');
        }

    })
});
