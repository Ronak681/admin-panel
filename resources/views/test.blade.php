{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>
    <select class="js-example-basic-multiple form-control form-control-lg " name="states[]" multiple="multiple">
        <option value="AL">Alabama</option>
        <option value="AL">Alabama</option>
        <option value="AL">Alabama</option>
        <option value="AL">Alabama</option>
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
      </select>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <title>Datepicker Test</title>
    <script>
        $(document).ready(function() {
            $('#delivery_date').datepicker({
                dateFormat: 'yy/mm/dd'
            });
            $('#create_date').datepicker({
                dateFormat: 'yy/mm/dd'
            });
        });
    </script>
</head>
<body>
    <input type="text" id="delivery_date" />
    <input type="text" id="create_date" />
</body>
</html>
