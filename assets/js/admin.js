$(document).ready(function() {
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    $('input[name=is_directory]').on('ifChecked', function(e) {
        var attr = $('input[name=attachment]').attr('disabled');

        if (typeof attr === typeof undefined || attr === false) {
            $('input[name=attachment]').attr("disabled", "disabled");
        }
    });

    $('input[name=is_directory]').on('ifUnchecked', function(e) {
        var attr = $('input[name=attachment]').attr('disabled');

        if (typeof attr !== typeof undefined && attr !== false) {
            $('input[name=attachment]').removeAttr("disabled");
        }
    });

    $('#pager-form select').on('change', function(e) {
        $('#pager-form').submit();
    });

    $('.remove-button').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);
        var url = $this.attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data, status, xhr) {
                if (data.modal) {
                    var $modal = $(data.modal);
                    $('body').append($modal);
                    $modal.filter('.modal').modal();

                    $(document).on('hidden.bs.modal', '.modal', function () {
                        $(this).remove();
                    });
                }
            }
        });

        return false;
    });

    $('.html-editable').ckeditor({
        {
	filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
}
    });
});
