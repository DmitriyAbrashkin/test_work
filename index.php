<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="radio" name="filer_param" checked value="1"> Испытательный срок
    <input type="radio" name="filer_param" value="2"> Уволенные
    <input type="radio" name="filer_param" value="3"> Начальники
    <input type="button" value="Отфильтровать " onclick="filter(1)">

    <div id="table">
    </div>

</body>
<script src="script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        filter(1)
    });
</script>

</html>