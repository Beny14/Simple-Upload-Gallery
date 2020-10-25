<?php
  $_SESSION['username'] = "Beny"; // am pornit sesiunea
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <main>
      <section class="gallery-links">
        <div class="wrapper">
          <h2>Gallery</h2>

          <div class="gallery-container">
            <?php

            include_once 'includes/dbh.inc.php'; // upload data base

            $sql = "SELECT * FROM galleryphoto ORDER BY order_gallery DESC"; // selecteaza tot din baza de date "galleryphoto"
            $stmt = mysqli_stmt_init($connect);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "SQL statements faield!"; // afiseaza eroare in caz ca nu se conecteaza la baza de date
            }else{
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="#">
                  <div style="background-image: url(includes/' . $row["imgFullName_gallery"] . ');"></div>
                  <h3>' . $row["title_gallery"] . '</h3>
                  <p>' . $row["desc_gallery"] . '</p>
                </a>';
              }
            }

            ?>
          </div>

          <?php
          if (isset($_SESSION['username'])) {
            echo '<div class="gallery-upload">
              <h2>Upload</h2>
              <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="filename" placeholder="File name..."><br><br>
                <input type="text" name="filetitle" placeholder="Image title..."><br><br>
                <input type="text" name="filedesc" placeholder="Image description..."><br><br>
                <input type="file" name="file"><br><br>
                <button type="submit" name="submit">Upload</button>
              </form>
            </div>';
          }
          ?>

        </div>
      </section>
    </main>
  </body>
</html>
