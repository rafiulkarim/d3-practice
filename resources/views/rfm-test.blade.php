<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.6.1.js"
            integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
</head>
<body>
<a href="filemanager/dialog.php?type=0" class="btn" id="iframe-btn" type="button">Open Filemanager</a>
</body>
<script>
    $('#iframe-btn').fancybox({

        'type': 'iframe',
        'autoScale': false
    });

    function responsive_filemanager_callback(field_id){
        console.log(field_id);
        var url=jQuery('#'+field_id).val();
        alert('update '+field_id+" with "+url);
        //your code
    }
</script>
</html>
