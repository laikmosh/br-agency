<?
$conexion = true;

$id = $datos["gallery"];
$dj = $pages->get($id);
$num = 1;
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