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
            "action" => ["site/create-user"], 
            "method" => "post"
        ]);
        ?>

        <div>
            <label for="name">Name</label>
            <input type="text" required name="name">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" required name="email">
        </div>
        
        <div>
            <label for="password">Password</label>
            <input type="password" required name="password">
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" required name="password_confirmation">
        </div>

        <div>
            <button class="btn btn-primary">Register</button>
        </div>       

        <?php
            ActiveForm::end();
        ?>
    </div>
    
</body>
</html>