<?php
session_start();
?>

<html>

    <body>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type = "file" name="myfile" size="100" /><br>
            <input type = "submit" value= "upload" / >
        </form>
    </body>
</html>

<?php
$domain="upload";
$file_name = $_FILES["myfile"]["name"];
$temp_arr = explode(".", $file_name);
$file_ext = array_pop($temp_arr);
$file_ext = trim($file_ext);
$file_ext = strtolower($file_ext);
$new_file_name = date("YmdHis") . '_' . rand(10000, 99999).'.'.$file_ext;
$s = new SaeStorage();
//$s->upload( 'imagefile',$_FILES["myfile"]["name"],$_FILES["myfile"]["name"]);
echo $aimage=$s->upload( 'upload','tset/'.$new_file_name,$_FILES["myfile"]["tmp_name"]);

$files = $s->getList($domain,"",100);
echo "<pre>";
    print_r($files);
echo "</pre>";

foreach((array)$files as $name){
    echo $s->getUrl($domain,$name)."<br>";
}
echo "<br>";

foreach((array)$files as $name){
  //echo "<img src=".$s->getUrl($domain,$name)." width='50%'. height='100%'.>";

  echo "<table border='5' align='center'>";
    echo "<tr>";

                echo "<td align='right'>";
            echo "<a target='_blank' href=".$s->getUrl($domain,$name). "><img src=".$s->getUrl($domain,$name)." width='30%' height='30%'"."></a>";
                        echo "<br><br>";
                        echo $s->getUrl($domain,$name)."<br>";
        echo "</td>";

    echo "</tr>";

  echo "</table>";
}

?>