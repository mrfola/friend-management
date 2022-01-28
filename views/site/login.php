<?php
use yii\bootstrap4\ActiveForm;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <div>
        <h1>Login</h1>

        <?php
        ActiveForm::begin([
            "action" => ["site/process-login"], 
            "method" => "post"
        ]);
        ?>

        <div>
            <label for="name">Email</label>
            <input type="email" required name="email">
        </div>
        
        <div>
            <label for="name">Password</label>
            <input type="password" required name="password">
        </div>

        <div>
            <button class="btn btn-primary">Login</button>
        </div>       

        <?php
            ActiveForm::end();
        ?>
    </div>
    
</body>
</html>