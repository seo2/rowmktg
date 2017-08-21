<?
	ini_set('memory_limit', '-1');
// Input parametres check
$w = intval($_GET['width']);
$h = intval($_GET['height']);
$mode = $_GET['mode']=='fit'?'fit':'fill';
if ($w <= 1 || $w >= 1000) $w = 100;
if ($h <= 1 || $h >= 1000) $h = 100;
 
$imgSrc = $_GET['img'];

$exif = @exif_read_data($imgSrc);
//print_r( $exif);
$ort = $exif['Orientation'];

$ext = pathinfo($imgSrc, PATHINFO_EXTENSION);

//echo $ext;

if($ext == 'PNG' || $ext == 'png'){

// Source image
$src = imagecreatefrompng($imgSrc);
 
     switch($ort) {
        case 3:
            $src = imagerotate($src, 180, 0);
            break;
        case 6:
            $src = imagerotate($src, -90, 0);
            break;
        case 8:
            $src = imagerotate($src, 90, 0);
            break;
    }
 
 
// Destination image with white background
$dst = imagecreatetruecolor($w, $h);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
 
 
// All Magic is here
scale_image($src, $dst, $mode);
 
 
// Output to the browser
Header('Content-Type: image/jpeg');
imagejpeg($dst);

	

	
}else{

// Source image
$src = imagecreatefromjpeg($imgSrc);
 
     switch($ort) {
        case 3:
            $src = imagerotate($src, 180, 0);
            break;
        case 6:
            $src = imagerotate($src, -90, 0);
            break;
        case 8:
            $src = imagerotate($src, 90, 0);
            break;
    }
 
 
// Destination image with white background
$dst = imagecreatetruecolor($w, $h);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
 
 
// All Magic is here
scale_image($src, $dst, $mode);
 
 
// Output to the browser
Header('Content-Type: image/jpeg');
imagejpeg($dst);

	
} 
 
function scale_image($src_image, $dst_image, $op = 'fit') {
    $src_width = imagesx($src_image);
    $src_height = imagesy($src_image);
 
    $dst_width = imagesx($dst_image);
    $dst_height = imagesy($dst_image);
 
    // Try to match destination image by width
    $new_width = $dst_width;
    $new_height = round($new_width*($src_height/$src_width));
    $new_x = 0;
    $new_y = round(($dst_height-$new_height)/2);
 
    // FILL and FIT mode are mutually exclusive
    if ($op =='fill')
        $next = $new_height < $dst_height;
     else
        $next = $new_height > $dst_height;
 
    // If match by width failed and destination image does not fit, try by height 
    if ($next) {
        $new_height = $dst_height;
        $new_width = round($new_height*($src_width/$src_height));
        $new_x = round(($dst_width - $new_width)/2);
        $new_y = 0;
    }
 
    // Copy image on right place
    imagecopyresampled($dst_image, $src_image , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);
}