<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
    {{--    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen"/>--}}
</head>
<body>
<textarea class="form-control description_required" id="content_en" name="description_en"
          required rows="3"></textarea>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
{{--<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>--}}
<script>
    window.onload = function () {
        CKEDITOR.replace('content_en', {
            // filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            // filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            // filebrowserImageBrowseUrl: 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
            filebrowserBrowseUrl : '@filemanager_get_resource(dialog.php)?akey=@filemanager_get_key()&type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl : '@filemanager_get_resource(dialog.php)?akey=@filemanager_get_key()&type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl : '@filemanager_get_resource(dialog.php)?akey=@filemanager_get_key()&type=1&editor=ckeditor&fldr=',
        });
    };
    $('.iframe-btn').fancybox({
        'width': 900,
        'height': 600,
        'type': 'iframe',
        'autoScale': false
    });

    function responsive_filemanager_callback(field_id) {
        var url = jQuery('#' + field_id).val();
        $(".cke_dialog_ui_input_text").attr('src', 'http://127.0.0.1:8000/' + url)
    }
</script>
</html>
