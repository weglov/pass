<?php

// link to the font file no the server
$fontr = 'font/AkzidenzGroteskPro-Regular.ttf';
$font = 'font/AkzidenzGroteskPro-Bold.ttf';
// controls the spacing between text
$i=30;
//JPG image quality 0-100
$quality = 9;

function create_image($user){

		global $font;
		global $fontr;		
		global $quality;
		$file = "covers/".md5($user['name'].$user['sername']).".png";	
	
			$encodedData=explode(',', $_POST["img"]);
			$data = base64_decode($encodedData[1]);
			// define the base image that we lay our text on
			$im = !empty($_POST["img"]) ? imagecreatefromstring($data) : imagecreatefrompng("pass.png");


			$name = ucfirst($user['name']);
			$sername = ucfirst($user['sername']);
			$job = $user['job'];
			$start = 718;
			



	# Добавляет тект
function addText (&$image, $font, $fontSize = 38, $textWidth = 100, $padding = 10, $textPadding = 40, $color, $text) {

    $i = 1;
    foreach (explode(PHP_EOL, wordwrap($text, $textWidth, PHP_EOL)) as $key => $word) {

        imagettftext($image, $fontSize , 0, 60, $padding + ($textPadding * $i), $color, $font, $word);
        $i++;

    }


}

$fontSize  = 42;
$textWidth = 55;
$color     = imagecolorallocate($im, 0, 0, 0);

addText($im, $font, $fontSize, 100, 710, 10, $color, $name);
addText($im, $font, $fontSize, 100, 750, 20, $color, $sername);
addText($im, $fontr, 24, $textWidth, 785, 38, $color, $job);


			// create the image
			imagepng($im, $file, $quality);
			

						
		return $file;	
}




	$user = array(
			'name'=> 'Имя', 
			'sername'=> 'Фамилия',
			'job'=> 'Должность'
	);
	
	
	if(isset($_POST['submit'])){
	
	$error = array();
	
		if(strlen($_POST['name'])==0){
			$error[] = 'Введите имя';
		}
		
		if(strlen($_POST['job'])==0){
			$error[] = 'Введите Должность и отдел';
		}		

	if(count($error)==0){
		$user = array(
				'name'=> $_POST['name'], 
				'sername'=> $_POST['sername'], 
				'job'=> $_POST['job']
		);			
	}
		
	}
$filename = create_image($user);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pass</title>
	<link href="index.css" rel="stylesheet" type="text/css" />
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.5/fabric.min.js"></script>
</head>

<body>

<div class="pass">

<header>
	По проблемам сервиса писать e-mail: <a href="mailto:support@ren-tv.com">support@ren-tv.com</a>
</header>
<div class="container">
	<div class="image">
	<div class="image_wrap"> 
		<div class="canvas">

			<canvas id="photo" width="637" height="1003"></canvas>
		</div>
			<img src="<?=$filename;?>?id=<?=rand(0,1292938);?>"/>
		</div>
		<div id="get">
			<a target="_blank" href="<?=$filename;?>?id=<?=rand(0,1292938);?>">Скачать!</a>
		</div>
	</div>
	<div class="form">	
		
		<div class="dynamic-form">
		<form action="" method="post">
		<dib id="newphoto">Изменить фото</dib>
		<div class="newphoto">		
			<label>Загрузить фото</label>
			<input type="file" id="imageLoader" name="imageLoader" />
			<div id="range_wrap">
			<label>Размер</label>
				<input id="range" type="range" min="0" max="200"/>
			</div>
		</div>
		<label>Имя</label>
		<input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" name="name" maxlength="20" placeholder="Имя">
		<label>Фамилия</label>
		<input type="text" value="<?php if(isset($_POST['sername'])){echo $_POST['sername'];}?>" name="sername" maxlength="20" placeholder="Фамилия">
		<label>Должность и отдел</label>
		<textarea rows="5" type="text" name="job" placeholder="Должность и отдел"><?php if(isset($_POST['job'])){echo $_POST['job'];}?></textarea><br/>
		<textarea name="img" id="img" cols="30" rows="10"><?php if(isset($_POST['img'])){echo $_POST['img'];}?></textarea>
		<input name="submit" type="submit" class="btn btn-primary" value="Сгенерировать пропуск" />
		</form>
		
		<?php if(isset($error)){
			foreach($error as $errors){
				echo '<div class="error">'.$errors.'</div>';		
			}	
		}?>
		
		</div>
	</div>
</div>
<script src="main.js"></script>
</body>
</html>
