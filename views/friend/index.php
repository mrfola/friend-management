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
        <button type="button" class="btn btn-primary px-4" data-toggle="modal" data-target="#addFriendModal">
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
            <table class="friendsTable">
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
                    <tr class = "<?='friend-input'.$friend->id; ?> mb-4">
                        <?php
                            ActiveForm::begin([
                                    'action' => ['friend/update'],
                                    'method' => 'post',
                                ]);
                        ?>
                        <td><?= $i; ?></td>
                        <td><input class="form-control" disabled required type="text" name="name" value="<?=$friend->name;?>"></td>
                        <td><input class="form-control" disabled required type="text" name="email" value="<?=$friend->email;?>"></td>
                        <td><input class="form-control" disabled required type="text" name="phone_number" value="<?=$friend->phone_number;?>"></td>
                        <td>
                            <select class="form-control" disabled required type="text" name="type">
                                <option value="Acquintance" <?= ($friend['type'] == "Acquintance")? "selected='selected'" : '' ?>>Acquintance</option>
                                <option value="Friends" <?= ($friend['type'] == "Friends")? "selected='selected'" : '' ?>>Friends</option>
                                <option value="Close Friends" <?= ($friend['type'] == "Close Friends")? "selected='selected'" : '' ?>>Close Friends</option>
                                <option value="Best Friends" <?= ($friend['type'] == "Best Friends")? "selected='selected'" : '' ?>>Best Friends</option>
                            </select>
                        </td>
                        <td>
                                <input type="hidden" name="id" value="<?=$friend['id'];?>">
                                <input type="button" class="btn btn-primary" id="edit-button" locator-class="<?='friend-input'.$friend->id; ?>" value="Edit">
                                <button class='btn btn-primary' id="update-button" style="display:none;">Update</button>
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
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFriendModal<?=$friend['id'];?>" data-id="<?=$friend['id'];?>">
                                Delete
                            </button>  
                        <?php
                            ActiveForm::end();
                        ?>
                        </td>

                    </tr>

                    <!-- Delete Friends Modal -->
                    <div class="modal fade" id="deleteFriendModal<?=$friend['id'];?>" tabindex="-1" aria-labelledby="deleteFriend" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteFriend<?=$friend['id'];?>">Delete Friend</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                                ActiveForm::begin([
                                    'action' => ['friend/destroy'],
                                    'method' => 'post',
                                ]);
                                ?>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this friend: <?= $friend->name; ?>?</p>
                                    <input type="hidden" name="id" value="<?=$friend['id'];?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                </div>

                            <?php
                                ActiveForm::end();
                            ?>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>

            <?php 
                }
            ?>
        </div>

    <!-- Add Friends Modal -->
    <div class="modal fade" id="addFriendModal" tabindex="-1" aria-labelledby="addFriend" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFriend">Add Friend</h5>
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Friend</button>
            </div>
            <?php
                ActiveForm::end()
            ?>
            
        </div>
    </div>

    <?php
        $this->registerJsFile(
            '@web/js/main.js',
            ['depends' => [\yii\web\JqueryAsset::class]]
        );
    ?>
</body>
</html>