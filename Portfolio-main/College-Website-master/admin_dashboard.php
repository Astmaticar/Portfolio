<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// =======================
// API dio unutar istog fajla
// =======================
if(isset($_GET['api']) && $_GET['api'] == '1'){
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $galleryData = [];
        $result = $conn->query("SELECT * FROM gallery ORDER BY id ASC");
        while($row = $result->fetch_assoc()){
            $galleryData[] = $row;
        }
        echo json_encode($galleryData);
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = $_POST['action'] ?? '';

        if($action === 'add'){
            $caption = $_POST['caption'] ?? '';
            $category = $_POST['category'] ?? '';
            if(isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK){
                $uploadDir = 'image/gallery_pics/';
                $fileName = basename($_FILES['imageFile']['name']);
                $targetFile = $uploadDir . $fileName;
                if(move_uploaded_file($_FILES['imageFile']['tmp_name'], $targetFile)){
                    $stmt = $conn->prepare("INSERT INTO gallery (src, caption, category) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $targetFile, $caption, $category);
                    $stmt->execute();
                    echo json_encode(['success'=>true]);
                    exit;
                }
            }
            echo json_encode(['error'=>'Upload failed']);
            exit;
        }

        if($action === 'update'){
            $id = intval($_POST['id']);
            $caption = $_POST['caption'] ?? '';
            $category = $_POST['category'] ?? '';
            $stmt = $conn->prepare("UPDATE gallery SET caption=?, category=? WHERE id=?");
            $stmt->bind_param("ssi",$caption,$category,$id);
            $stmt->execute();
            echo json_encode(['success'=>true]);
            exit;
        }

        if($action === 'delete'){
            $id = intval($_POST['id']);
            $res = $conn->query("SELECT src FROM gallery WHERE id=$id LIMIT 1");
            if($row = $res->fetch_assoc()){
                if(file_exists($row['src'])) unlink($row['src']);
                $conn->query("DELETE FROM gallery WHERE id=$id");
                echo json_encode(['success'=>true]);
                exit;
            }
            echo json_encode(['error'=>'Delete failed']);
            exit;
        }
    }
    exit;
}

// =======================
// Backend dio za admin HTML
// =======================
$categories = ['aquarelle','oil','coal','mixed'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Gallery</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
.home-btn i { font-size: 16px; }
</style>
</head>
<body>

<a href="index.php" class="home-btn">
    <i class="fa fa-home" aria-hidden="true"></i> Home
</a>

<h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>

<div class="admin-gallery">
<h2>Gallery</h2>
<ul id="galleryList"></ul>
</div>

<div class="add-new-image">
<h2>Add New Image</h2>
<form id="addForm" enctype="multipart/form-data">
    <input type="text" name="caption" placeholder="Caption" required>
    <select name="category">
        <?php foreach($categories as $cat): ?>
        <option value="<?php echo $cat; ?>"><?php echo ucfirst($cat); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="file" name="imageFile" accept="image/*" required>
    <button type="submit">Add Image</button>
</form>
</div>

<script>
const galleryList = document.getElementById('galleryList');
const addForm = document.getElementById('addForm');

// Učitavanje galerije
function loadGallery(){
    fetch('admin_dashboard.php?api=1')
    .then(res => res.json())
    .then(data => {
        galleryList.innerHTML = '';
        data.forEach(img => {
            const li = document.createElement('li');
            li.innerHTML = `
                <img src="${img.src}" alt="">
                <p>ID: ${img.id}</p>
                <input type="text" value="${img.caption}" placeholder="Caption">
                <select>
                    <option value="aquarelle" ${img.category==='aquarelle'?'selected':''}>Aquarelle</option>
                    <option value="oil" ${img.category==='oil'?'selected':''}>Oil</option>
                    <option value="coal" ${img.category==='coal'?'selected':''}>Coal</option>
                    <option value="mixed" ${img.category==='mixed'?'selected':''}>Mixed</option>
                </select>
                <button class="update-btn">Update</button>
                <button class="delete-btn">Delete</button>
            `;
            // Update
            li.querySelector('.update-btn').addEventListener('click',()=>{
                const caption = li.querySelector('input').value;
                const category = li.querySelector('select').value;
                const formData = new FormData();
                formData.append('action','update');
                formData.append('id',img.id);
                formData.append('caption',caption);
                formData.append('category',category);
                fetch('admin_dashboard.php?api=1',{
                    method:'POST',
                    body:formData
                }).then(()=>loadGallery());
            });
            // Delete
            li.querySelector('.delete-btn').addEventListener('click',()=>{
                if(!confirm('Delete this image?')) return;
                const formData = new FormData();
                formData.append('action','delete');
                formData.append('id',img.id);
                fetch('admin_dashboard.php?api=1',{
                    method:'POST',
                    body:formData
                }).then(()=>loadGallery());
            });
            galleryList.appendChild(li);
        });
    });
}

loadGallery();

// Add new image
addForm.addEventListener('submit',(e)=>{
    e.preventDefault();
    const formData = new FormData(addForm);
    formData.append('action','add');
    fetch('admin_dashboard.php?api=1',{
        method:'POST',
        body: formData
    }).then(res => res.json())
      .then(()=> {
          addForm.reset();
          loadGallery();
      });
});
</script>

</body>
</html>
