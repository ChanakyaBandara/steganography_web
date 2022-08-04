 <?php
  date_default_timezone_set("asia/colombo");
  require 'file_upload.php';
  define('orginal_dir', 'resources');

  if (isset($_POST['text_message']) || isset($_POST['file'])) {

    $txt = $_POST['text_message'];

    $file_new_name = "0";
    $file_orginal_name = "0";

    if ($_FILES['file']['size'] <> 0) {
      $file = $_FILES['file'];
      $allowd = array('png', 'jpg', 'jpeg');
      $fileDestination = orginal_dir;
      $file_orginal_name = $file['name'];
      $file_new_name = uploadfile($file, $allowd, $fileDestination);
      writeTxtFile($txt);
      $shelloutput = encord($file_new_name);
      $myObj=new stdClass;
      $myObj->encryptedFileName = 'enc_' . $file_new_name;
      $myObj->Text = $txt;
      $myObj->shelloutput = $shelloutput;
      echo json_encode($myObj);
    }
  }

  if (isset($_FILES['encodedFile'])) {

    $file_new_name = "0";
    $file_orginal_name = "0";

    if ($_FILES['encodedFile']['size'] <> 0) {
      $file = $_FILES['encodedFile'];
      $allowd = array('png', 'jpg', 'jpeg');
      $fileDestination = orginal_dir;
      $file_orginal_name = $file['name'];
      $file_new_name = uploadfile($file, $allowd, $fileDestination);
      $shelloutput = decord($file_new_name);
      $myObj=new stdClass;
      $myObj->shelloutput = $shelloutput;
      echo json_encode($myObj);
    }
  }

  function writeTxtFile($txt)
  {
    $myfile = fopen("resources/file.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $txt);
    fclose($myfile);
  }

  function encord($var1)
  {
    $command1 =  'python Image_Steganography.py -e -i resources/' . $var1 . ' -f resources/file.txt -o resources/enc_' . $var1;
    $command = escapeshellcmd($command1);
    $output = shell_exec($command);
    return $output;
  }

  function decord($var1)
  {
    $command1 =  'python Image_Steganography.py -d -i resources/' . $var1 . ' -f resources/file_concealed.txt';
    $command = escapeshellcmd($command1);
    $output = shell_exec($command);
    return $output;
  }
  ?>
