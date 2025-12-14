<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// Path do JSON-a
$galleryFile = 'Poppins/gallery_data.json';

// Učitavanje trenutnih slika
$galleryData = [];
if(file_exists($galleryFile)){
    $json = file_get_contents($galleryFile);
    $galleryData = json_decode($json, true);
}

// Handle add new image
if(isset($_POST['add_image'])){
    $caption = $_POST['caption'];
    $category = $_POST['category'];

    if(isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK){
        $uploadDir = 'image/gallery_pics/';
        $fileName = basename($_FILES['imageFile']['name']);
        $targetFile = $uploadDir . $fileName;

        if(move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFile)){
            $newImage = [
                'src' => $targetFile,
                'alt' => '', // alt nije potreban
                'caption' => $caption,
                'category' => $category,
                'id' => count($galleryData) + 1 // automatski ID
            ];
            $galleryData[] = $newImage;
            file_put_contents($galleryFile, json_encode($galleryData, JSON_PRETTY_PRINT));
            header("Location: admin_dashboard.php");
            exit;
        }
    }
}

// Handle delete image
if(isset($_GET['delete'])){
    $index = intval($_GET['delete']);
    if(isset($galleryData[$index])){
        $fileToDelete = $galleryData[$index]['src'];
        if(file_exists($fileToDelete)){
            unlink($fileToDelete);
        }
        array_splice($galleryData, $index, 1);
        // Update IDs
        foreach($galleryData as $i => &$img){
            $img['id'] = $i+1;
        }
        file_put_contents($galleryFile, json_encode($galleryData, JSON_PRETTY_PRINT));
        header("Location: admin_dashboard.php");
        exit;
    }
}

// Handle update image
if(isset($_POST['update_image'])){
    $index = intval($_POST['index']);
    $caption = $_POST['caption'];
    $category = $_POST['category'];
    if(isset($galleryData[$index])){
        $galleryData[$index]['caption'] = $caption;
        $galleryData[$index]['category'] = $category;
        file_put_contents($galleryFile, json_encode($galleryData, JSON_PRETTY_PRINT));
        header("Location: admin_dashboard.php");
        exit;
    }
}

// Categories for dropdown
$categories = ['aquarelle','oil','coal','mixed'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Gallery</title>
<style>
body { font-family: Arial, sans-serif; padding: 20px; }
h1 { margin-bottom: 20px; }
.admin-gallery ul { list-style: none; padding: 0; display: flex; flex-wrap: wrap; }
.admin-gallery li { margin: 10px; border: 1px solid #ccc; padding: 10px; width: 220px; text-align: center; }
.admin-gallery img { max-width: 180px; height: auto; display: block; margin-bottom: 5px; }
input, select, button { display: block; margin: 5px 0; padding: 5px; width: 100%; }
.delete-btn { background-color: red; color: white; border: none; cursor: pointer; }
.update-btn { background-color: green; color: white; border: none; cursor: pointer; }
.add-new-image { margin-top: 40px; }
</style>
<style>
.home-btn {
    position: fixed;
    top: 15px;
    right: 20px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    font-family: Arial, sans-serif;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    z-index: 1000;
    display: flex;
    align-items: center;
    gap: 8px;
}

.home-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 10px rgba(0,0,0,0.25);
    background: linear-gradient(135deg, #2575fc, #6a11cb);
}

.home-btn i {
    font-size: 16px;
}
</style>

</head>
<body>

<!-- Home button -->
    <a href="index.php" class="home-btn">
        <i class="fa fa-home" aria-hidden="true"></i> Home
    </a>

    <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>

<div class="admin-gallery">
<h2>Existing Images</h2>
<ul>
<?php foreach($galleryData as $index => $img): ?>
<li>
<img src="<?php echo $img['src']; ?>" alt="">
<p>ID: <?php echo $img['id']; ?></p>
<form method="post" style="margin-bottom:5px;">
    <input type="hidden" name="index" value="<?php echo $index; ?>">
    <input type="text" name="caption" value="<?php echo htmlspecialchars($img['caption']); ?>" placeholder="Caption" required>
    <select name="category">
        <?php foreach($categories as $cat): ?>
        <option value="<?php echo $cat; ?>" <?php if($img['category']==$cat) echo 'selected'; ?>><?php echo ucfirst($cat); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" name="update_image" class="update-btn">Update</button>
</form>
<a href="admin_dashboard.php?delete=<?php echo $index; ?>"><button class="delete-btn">Delete</button></a>
</li>
<?php endforeach; ?>
</ul>
</div>

<div class="add-new-image">
<h2>Add New Image</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="caption" placeholder="Caption" required>
    <select name="category">
        <?php foreach($categories as $cat): ?>
        <option value="<?php echo $cat; ?>"><?php echo ucfirst($cat); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="file" name="imageFile" accept="image/*" required>
    <button type="submit" name="add_image">Add Image</button>
</form>
</div>

</body>
</html>
