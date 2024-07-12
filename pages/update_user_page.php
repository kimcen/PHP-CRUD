<?php 
include('../header.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    
    // Get color ids
    $results = $connection->query("SELECT color_id FROM user_colors WHERE user_id = " .$id);
    
    // Extract color_id values into $color_ids array
    $results = $results->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        $color_ids[] = (int) $row['color_id'];
    }
    $color_ids = implode(",", $color_ids);
} else { 
    header("Location: {$URL_users}?message=Missing ID");
    exit();
}
?>

<div class="main_content" style="justify-content: center; align-items: center;">
    <div class="inside_header">
        <h2 style="padding-bottom: 10px;">Update User <?php echo $name?></h2>
    </div>
    <form action=<?php echo "{$URL_update_user}?id={$id};" ?> method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control"value="<?php echo $email?>">
        </div>
        <div class="form-group">
            <label for="color">Color ids (input as comma separated integers)</label>
            <input type="text" name="color_ids" class="form-control" value="<?php echo $color_ids?>">
        </div>
        <input type="submit" class="btn btn-success" name="update_user" value="Update">
        </form>
    </div>
</div>
<?php include('../footer.php'); ?> 