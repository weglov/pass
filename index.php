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
	

			// define the base image that we lay our text on
			$im = imagecreatefrompng("pass.png");


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

$fontSize  = 36;
$textWidth = 55;
$color     = imagecolorallocate($im, 0, 0, 0);

addText($im, $font, $fontSize, 100, 705, 10, $color, $name);
addText($im, $font, $fontSize, 100, 740, 20, $color, $sername);
addText($im, $fontr, 21, $textWidth, 770, 40, $color, $job);


			// create the image
			imagepng($im, $file, $quality);
			

						
		return $file;	
}



	$user = array(
			'name'=> 'Николай', 
			'sername'=> 'Римский-Корсаков',
			'job'=> 'Ведущий экономист по финансовой работе Финансово-экономического отдела'
	);
	
	
	if(isset($_POST['submit'])){
	
	$error = array();
	
		if(strlen($_POST['name'])==0){
			$error[] = 'Введите имя';
		}
		
		if(strlen($_POST['job'])==0){
			$error[] = 'Введите фамилию';
		}		

	if(count($error)==0){
		$user = array(
				'name'=> $_POST['name'], 
				'sername'=> $_POST['sername'], 
				'job'=> $_POST['job']
		);			
	}
		
	}

// run the script to create the image
$filename = create_image($user);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pass</title>
	<link href="index.css" rel="stylesheet" type="text/css" />
	<script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.5/fabric.min.js"></script>
</head>

<body>

<div class="pass">

<header>

</header>
<div class="container">
	<div class="image">
		<img src="<?=$filename;?>?id=<?=rand(0,1292938);?>"/>
	</div>
	<div class="form">	

		<div class="dynamic-form">
		<form action="" method="post">
		<label>Имя</label>
		<input type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" name="name" maxlength="15" placeholder="Name">
		<label>Фамилия</label>
		<input type="text" value="<?php if(isset($_POST['sername'])){echo $_POST['sername'];}?>" name="sername" maxlength="15" placeholder="Name">
		<label>Должность и отдел</label>
		<textarea rows="5" type="text" name="job" placeholder="Job Title"><?php if(isset($_POST['job'])){echo $_POST['job'];}?></textarea><br/>
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
</body>
</html>
