<!DOCTYPE HTML>
<html>
<head>
    <title>runnercard</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <p class="main"><b><i>RunnerCard</i></b></p>
        <p class="small-header">Racing Pictures</p>
    </header>
    <div class="grid-container">
        <?php
        $compressed_path = "img/compressed/";
        $thumb_path = "img/thumb/";

        // Get and sort files for consistency
        $files = scandir($compressed_path);
        natsort($files);
        $files = array_values(array_filter($files, function($f) use ($compressed_path) {
            return in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), ["jpg", "jpeg", "png", "gif"]);
        }));

        // Display thumbnails linking to landing.php
        foreach ($files as $file) {
            $thumb = $thumb_path . $file;
            $compressed = $compressed_path . $file;
            echo "<a href='landing.php?file=" . urlencode($compressed) . "'>
                      <img src='$thumb' alt='Thumbnail'>
                  </a>";
        }
        ?>
    </div>
</div>
</body>
</html>
