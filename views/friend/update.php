<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Friend</title>
</head>
<body>
    <?php
        ActiveForm::begin([
                'action' => ['friend/update'],
                'method' => 'post'
        ]);
    ?>

    <input type="hidden" name="id" value="<?= $friend['id']; ?>" />
    <input type="text" name="name" value="<?= $friend['name']; ?>" />
    <select type="text" name="type">
        <option value="Acquintance" <?= ($friend['type'] == "Acquintance")? "selected='selected'" : '' ?>>Acquintance</option>
        <option value="Friends" <?= ($friend['type'] == "Friends")? "selected='selected'" : '' ?>>Friends</option>
        <option value="Close Friends" <?= ($friend['type'] == "Close Friends")? "selected='selected'" : '' ?>>Close Friends</option>
        <option value="Best Friends" <?= ($friend['type'] == "Best Friends")? "selected='selected'" : '' ?>>Best Friends</option>
    </select>
    <input type="text" name="email" value="<?= $friend['email']; ?>" />
    <input type="text" name="phone_number" value="<?= $friend['phone_number']; ?>" />

    <button type="submit">Update</button>

    <?php
        ActiveForm::end();
    ?>
</body>
</html>