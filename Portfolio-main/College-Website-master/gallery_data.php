<?php
// Poppins/gallery_data.php

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

// Uključi konekciju na bazu (prilagodi putanju ako treba)
require_once 'config.php';  // ili '../Connection.php' ili kako god se zove tvoja konekcija

// Dohvati sve slike iz baze
$sql = "SELECT id, src, caption, category FROM gallery ORDER BY id ASC";
$result = $conn->query($sql);

$gallery = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Točno isti format kao u tvom starom gallery_data.json
        $gallery[] = [
            "id"       => $row['id'],
            "src"      => $row['src'],
            "caption"  => $row['caption'],
            "category" => $row['category']
        ];
    }
}

// Vrati JSON – identičan onome što je bio u .json fileu
echo json_encode($gallery);

$conn->close();
?>