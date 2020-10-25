<body>
<!-- Creem un <form> pentu a uploada un fisier sau orice alt ceva -->
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"/>
    <input type="submit" name="submit" value="SUBMIT"/>
  </form>

<?php

if(isset($_POST['submit'])){ // Verificam daca s-a apasat butonul de SUBMIT
  $file = $_FILES['file']; // Variabila de selectare a lui file din <input>
  print_r($file); // (Necesar doar la pana afli variabilele) Afisarea in array a tuturor pasilor ce trebuie urmati pentru a uploada o imagine
// Variabilele de care avem nevoie in parcurgerea upload-ului
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];
// Punerea si verificarea extensie, sa fie si lowercase
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
// Extensiile de care avem nevoie pentru a uploada imaginea
  $allowed = array('jpg', 'jpeg', 'png', 'pdf');
// Codul general de functionare bazat pe ' nume_fotoografie - extensie '
  if (in_array($fileActualExt, $allowed)) { // Accepta doar tipurile specificate in $allowed
    if($fileError === 0){ // Daca nu s-a introdus nici un fisier
      if ($fileSize < 5000000) { // Marimea fisierului, de cat sa fie
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'Uploads/' . $fileNameNew; // Destinatia upload-ului
        move_uploaded_file($fileTmpName, $fileDestination); // Functie ce muta imaginea unde dorim noi
        header("Location: learn.php?uploadsucces"); // Functia in care ne avertizeaza ca s-a incarcat cu succes
      } else {
        echo "Your file is to big"; // Alerta in caz ca imaginea este prea mare
      } // End 4-th if
    } else {
      echo "Error upload your file"; // Alerta in caz ca nu s-a uploadat nici o imagine
    } // End 3-th if
  }else{
    echo "You cannot upload files of this type"; // Alerta in caz ca este o alta extensie decat cea specificata
  } // End 2-th if
} // End 1-th if

?>
</body>
