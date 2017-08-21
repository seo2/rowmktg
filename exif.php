<?


$imgSrc = $_GET['img'];
$exif = exif_read_data($imgSrc);
print_r( $exif);
 $ort = $exif['Orientation'];

echo $ort;





?>