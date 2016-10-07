<?
require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
header("Cache-Control: no-store, no-cache, must-revalidate");
$APPLICATION->SetTitle("Пропуско-делка");
?>	
<iframe src="http://2015.ren.tv/pass/" frameborder="0"></iframe>
<style>
	iframe {
	width: 100%;
    height: 800px;
	}
</style>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
