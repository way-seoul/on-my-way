<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script defer src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="public/styles.css" />
</head>
<body>
    <?php include 'header.php'; ?>
    <?= $html ?>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=<?=$db_password = $_SERVER['ONMYWAY_GMAP_KEY'];?>&callback=initMap&v=weekly&libraries=geometry"
      defer
    ></script>
</body>
</html>
