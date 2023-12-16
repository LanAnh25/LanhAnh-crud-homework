<?php require_once('partial/header.php');
    require_once('./database/database.php');
    $person = selectOnestudent($_GET['id']);
?>
    <div class="container p-4">
        <form action="update_model.php<?="?id=" . $_GET['id']?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" value="<?= $person[0]['name']?>" name="name">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Age" value="<?= $person[0]['age']?>" name="age">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" value="<?= $person[0]['email']?>" name="email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Image URL" value="<?= $person[0]['profile']?>" name="image_url">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </form>
    </div>
<?php require_once('partial/footer.php'); ?>