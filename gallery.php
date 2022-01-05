<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="gallery_styles.css">
</head>

<?php
$json = file_get_contents('crimson_vow.json');
$obj = json_decode($json, TRUE);
?>

<body>
    <section id="card_container">
    <?php
        foreach($obj['cards'] as $key => $value) {
        echo "<div>";
        echo "<img src=" . $value['imageUrl'] . " alt='About picture here.'>";
        echo "</div>";
        }
    ?>
    </section>
</body>

</html>