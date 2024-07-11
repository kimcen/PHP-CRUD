<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" href= 'style.css'>
<div class="main_content">
    <div class="inside_header">
        <h1 style="padding-bottom: 10px;font-size: 56px;">Users</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_user">Add user</button>
    </div>
    <div class="message">
        <?php
            if(isset($_GET['message'])){
                echo "<h6>".$_GET['message']."</h6>";
            }
        ?>
    </div>
    <div class="data_table">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th class="button">ID</th>       
                    <th class="name">Name</th>    
                    <th style="width: 20%">Email</th>
                    <th style="width: 10%">Colors</th>
                    <th class="button">Update</th>
                    <th class="button">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // insert database values into table
                    foreach($users as $user) {
                        echo sprintf(
                                '<tr>
                                    <td class="button">%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td class="button"><a href="pages/update_user_page.php?id=%s&name=%s&email=%s" class="btn btn-success">Update</a></td>
                                    <td class="button"><a href="pages/delete_user.php?id=%s" class="btn btn-danger">Delete</a></td>
                                </tr>',
                            $user->id, $user->uname, $user->email, $user->color, $user->id, $user->uname, $user->email, $user->id); 
                    }
                    ?>
            </tbody>
        </table>
    </div>
</div>

<form action="pages/insert_user.php" method="POST">
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add user</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uname">Name</label>
                        <input type="text" name="uname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="color">Color ids (input as comma separated integers)</label>
                        <input type="text" name="color_ids" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_user" value="Add">
                </div>
            </div>
        </div>
    </div>
</form>
<?php include('footer.php'); ?> 
    