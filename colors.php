<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" href= 'style.css'>
<div class="main_content">
    <div class="inside_header">
        <h2 style="padding-bottom: 10px;font-size: 56px;">Colors</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_color">Add Color</button>
    </div>
    <div class="message" style="text-align: center;">
        <?php
            // Prints the output message from CUD operations
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
                    <th>Colors</th>    
                    <th class="button">Update</th>
                    <th class="button">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // insert database values into table
                    foreach($colors as $color) {
                        $name = $color->name;
                        $id = $color->id;
                        echo "<tr>
                                  <td class='button'>{$id}</td>
                                  <td>{$name}</td>
                                  <td class='button'><a href='{$URL_update_color_page}?id={$id}&name={$name}' class='btn btn-success'>Update</a></td>
                                  <td class='button'><a href='{$URL_delete_color}?id={$id}' class='btn btn-danger'>Delete</a></td>
                              </tr>"; 
                    }
                    ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pop up window -->
<form action="<?php echo $URL_insert_color?>" method="POST">
    <div class="modal fade" id="add_color" tabindex="-1" role="dialog" aria-labelledby="colorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="colorModalLabel">Add Color</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="c_name">Color Name</label>
                        <input type="text" name="c_name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="add_color" value="Add">
                </div>
            </div>
        </div>
    </div>
</form>
<?php include('footer.php'); ?> 
    