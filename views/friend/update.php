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
    <div class="row mb-4">
            <h1>Edit Friends</h1>
    </div>

    <?php
        ActiveForm::begin([
                'action' => ['friend/update'],
                'method' => 'post'
        ]);
    ?>
        <input type="hidden" name="id" value="<?= $friend['id']; ?>" />

    <div class="form-group">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" name="name" value="<?= $friend['name']; ?>" />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="text" name="email" value="<?= $friend['email']; ?>" />
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input class="form-control" type="text" name="phone_number" value="<?= $friend['phone_number']; ?>" />
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Friend Level</label>
            <select class="form-control" type="text" name="type">
                <option value="Acquintance" <?= ($friend['type'] == "Acquintance")? "selected='selected'" : '' ?>>Acquintance</option>
                <option value="Friends" <?= ($friend['type'] == "Friends")? "selected='selected'" : '' ?>>Friends</option>
                <option value="Close Friends" <?= ($friend['type'] == "Close Friends")? "selected='selected'" : '' ?>>Close Friends</option>
                <option value="Best Friends" <?= ($friend['type'] == "Best Friends")? "selected='selected'" : '' ?>>Best Friends</option>
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Update</button>

    </div>
    <?php
        ActiveForm::end();
    ?>
</body>
</html>