<?php
// Include your database connection file if needed
include ("../conn/conn.php");

if(isset($_GET['image'])) {
    $imageId = $_GET['image'];

    // Fetch the image name from the database using $imageId
    $stmt = $conn->prepare("SELECT image_name FROM tbl_image WHERE tbl_image_id = ?");
    $stmt->execute([$imageId]);
    $row = $stmt->fetch();
    $image = $row['image_name'];

    // Delete the image record from the database
    $stmt = $conn->prepare("DELETE FROM tbl_image WHERE tbl_image_id = ?");
    $stmt->execute([$imageId]);

    // Remove the image file from the folder
    unlink("../images/" . $image);

    // Redirect back to the gallery page or any other appropriate page
    header("Location: http://localhost/image-accordion-gallery-app/");
    exit();
}
?>
