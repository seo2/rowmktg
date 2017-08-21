<? 
	include('header.php');
?>
<ul>
  <?php
	$dirname = "catalogo/kids2017/";// Esta es la carpeta que contiene las fotos.
	$images = glob($dirname."*.jpg");
	foreach($images as $image) {
		//echo '<li><img src="'.$image.'" /></li>';
		$i++;
		
		$desc = str_replace($dirname, '', $image);
		$desc = str_replace('.jpg', '', $desc);
		
		$data = Array (
			"camID" 	=> 57, // este ID debe ser cambiado por el catalogo donde se suben las fotos.
			"camDesc" 	=> $desc,
			"camFile" 	=> $image,
		);	
		$id = $db->insert ('catalogo', $data);	
		
	}
	echo $i.' fotos agregadas desde '. $dirname;
	?>
	
	
</ul>