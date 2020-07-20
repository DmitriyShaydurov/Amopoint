<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Тестовое задание №1</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="css/main.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="content mt-5">
            <div>
                <h1>Тестовое задание 1</h1>
                <form id="modelForm" method="POST" onsubmit="loadFile(event)" class=" mt-5">
                    <input  type="file" id="modelFile" name="modelFile" /> <br/>
                    <input  type="submit" id="submit" name="submit" value="Загрузить файл" class=" mt-3"/>
                </form>
                <span class="dot mt-3" id ="info-dot"></span>
                <p id="status"></p>
                <ul id = "array-output" class="list-group mt-5"></ul>
            </div>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>
