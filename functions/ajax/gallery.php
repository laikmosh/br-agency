<?
$conexion = true;

$id = $datos["gallery"];
$dj = $pages->get($id);
$num = 1;
if ($datos["key"] == "profile") {
	$active = "activ";
} else {
	$active = "";
}
$respuesta->gallery = '<div tabindex="0" style="background-image: url('.$dj->profile_image->last()->url.')" class="gallery_img '.$active.'" data-key="profile"></div>';
foreach ($dj->gallery as $key => $image) {
			if ($key == $datos["key"]) {
				$active = "activ";
			} else {
				$active = "";
			}
			$respuesta->gallery .= '<div tabindex="'.$num.'" style="background-image: url('.$image->url.')" class="gallery_img '.$active.'" data-key="'.$key.'"></div>';
			$num++;
		}
?>