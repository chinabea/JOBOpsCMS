<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditional Dropdown Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="form-group">
        <label for="primarySelect">Primary Select</label>
        <select class="form-control" id="primarySelect">
            <option value="">Please select</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
        </select>
    </div>

    <div class="form-group d-none" id="secondarySelectContainer">
        <label for="secondarySelect">Secondary Select</label>
        <select class="form-control" id="secondarySelect">
            <option value="">Please select</option>
            <option value="subOption1">Sub Option 1</option>
            <option value="subOption2">Sub Option 2</option>
        </select>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#primarySelect').change(function(){
            if($(this).val() !== ""){
                $('#secondarySelectContainer').removeClass('d-none');
            } else {
                $('#secondarySelectContainer').addClass('d-none');
            }
        });
    });
</script>

</body>
</html>
