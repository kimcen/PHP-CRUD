<link rel="stylesheet" type="text/css" href= '../style.css'>

<?php 
include('../header.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_GET['name'];
} else { 
    header('Location: ../colors.php?message=Missing ID');
    exit();
}
?>

<div class="main_content" style="justify-content: center; align-items: center;">
    <div class="inside_header">
        <h2 style="padding-bottom: 10px;">Update Color</h2>
    </div>
    <form action="update_color.php?id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name?>">
        </div>
        <input type="submit" class="btn btn-success" name="update_color" value="Update">
        </form>
    </div>
</div>
<?php include('../footer.php'); ?> 