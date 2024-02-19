<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/main.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1 class="title">Greetings traveller!!!</h1>
    <h2 class="subtitle">If you need to find the sum of two numbers you came in to right place</h2>
    <p class="description">Print two numbers in to fields below and get the result</p>
    <form class="form" action="/addition" method="post">
        <div class="form-inner">
            <label class="label"> First Number
                <?php
                $value = old('a');
                echo "<input class='input' type='text' name='a' value=$value>";
                showError('a')
                ?>
            </label>
            <label class="label"> Second Number
                <?php
                $value = old('b');
                echo "<input class='input' type='text' name='b' value=$value>";
                showError('b')
                ?>
            </label>
            <button class="button" type="submit">Get result</button>
        </div>
    </form>
    <?php
    $result = Session::get('result');
    if ($result) {
        echo "<h2 class='result-title'>Congratulations!</h2>";
        echo "<p class='result'> The result is <span class='result-value'>$result</span> </p>";
    }
    ?>
</div>
</body>
</html>
