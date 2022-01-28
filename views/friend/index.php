<?php

use yii\bootstrap4\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>
<body>
    <h1>Friends</h1>
    <div class="body">

        <?php if(!$friends)
        {
           echo" <p>You have no friends. You live a pretty boring life.</p>";

        }else
        {
        ?>
            <div class="todos">
                <div class="todo">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Friends</td>
                                <td>Type</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 0;
                                foreach($friends as $friend)
                                { 
                                    $i += 1;
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $friend->name; ?></td>
                                <td><?= $friend->type; ?></td>
                                <td>
                                <?php
                                    ActiveForm::begin([
                                            'action' => ['friend/edit'],
                                            'method' => 'get',
                                        ]);
                                ?>

                                        <input type="hidden" name="id" value="<?=$friend['id'];?>">
                                        <button class='btn btn-primary' type="submit">Edit</button>
                                    </form>
                                    <?php
                                        ActiveForm::end();
                                    ?>
                                </td>
                                <td> 
                                <?php
                                    ActiveForm::begin([
                                            'action' => ['friend/destroy'],
                                            'method' => 'post',
                                        ]);
                                ?>
                                        <input type="hidden" name="id" value="<?=$friend['id'];?>">

                                        <!-- Add confirmation pop-up -->
                                        <button type="submit" class='btn btn-danger' >Delete</button>
                                <?php
                                    ActiveForm::end();
                                ?>
                                </td>

                            </tr>

                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <?php 
                }
            ?>

            <div class="add-todo">
                <?php
                    ActiveForm::begin([
                            'action' => ['friend/store'],
                            'method' => 'post',
                        ]);
                ?>
                    <div class="form-row">
                        <div class="form-group">
                            <!-- CSRF Protection -->
                            <input type="text" class="form-input" name="name" required placeholder="Katerine"/>
                            <input type="email" class="form-input" name="email" required placeholder="Katerine@me.com"/>
                            <input type="text" class="form-input" name="phone_number" required placeholder="080-000-0000"/>

                            <select type="text" name="type">
                                <option value="Acquintance">Acquintance</option>
                                <option value="Friends">Friends</option>
                                <option value="Close Friends">Close Friends</option>
                                <option value="Best Friends">Best Friends</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <button class="form-submit btn btn-primary" type="submit">Add friend</button>
                        </div>
                    </div>
                <?php
                    ActiveForm::end()
                ?>
            </div>

        </div>

</body>
</html>