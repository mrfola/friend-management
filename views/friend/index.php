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
    <div class="row mb-4">
        <h1 class="col-8">Friends</h1>
        <!-- Trigger Add Friends -->
        <button type="button" class="btn btn-primary px-4" data-toggle="modal" data-target="#exampleModal">
        Add Friend
        </button>   
    </div>

    <div class="body">

        <?php if(!$friends)
        {
           echo" <p>You have no friends. You live a pretty boring life.</p>";

        }else
        {
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>Friends</td>
                        <td>Email</td>
                        <td>Phone Number</td>
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
                        <td><?= $friend->email; ?></td>
                        <td><?= $friend->phone_number; ?></td>
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

            <?php 
                }
            ?>

            <div class="add-friend">
                
            </div>

        </div>

    <!-- Add Friends Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Friend</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
                    ActiveForm::begin([
                            'action' => ['friend/store'],
                            'method' => 'post',
                        ]);
                ?>
            <div class="modal-body">
                <div class="form-group">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" class="form-input" name="name" required placeholder="Katerine"/>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" class="form-input" name="email" required placeholder="Katerine@me.com"/>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Phone Number</label>
                        <input class="form-control" type="text" class="form-input" name="phone_number" required placeholder="080-000-0000"/>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Friend Level</label>
                        <select class="form-control" type="text" name="type">
                            <option value="Acquintance">Acquintance</option>
                            <option value="Friends">Friends</option>
                            <option value="Close Friends">Close Friends</option>
                            <option value="Best Friends">Best Friends</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Friend</button>
                    </div>
                </div>
            </div>
            
                <?php
                    ActiveForm::end()
                ?>
            
        </div>
    </div>

</body>
</html>