(function ($) {
    let $photoPreview = $('#photo-review');
    $('.salary-img').click(function () {
        $photoPreview.html('<img src="'+ $(this).attr('src') + ' ">');
        $photoPreview.modal();
    });
    $('#date-select').datepicker({language:'ru-RU', 'format': 'YYYY-mm-dd'});
})(jQuery);
