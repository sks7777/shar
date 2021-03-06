<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ru" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="keywords" content="<?php if(isset($this->pageKeywords)) echo $this->pageKeywords; ?>" />
    <meta name="description" content="" />
</head>
<body>
<style>
     body {
         background: #797367 url(/images/loader_background.jpg);
     }
</style>

<?
    $links = array();
    $links []= array("text" => 'АРХИТЕКТУРНОЕ ПРОЕКТИРОВАНИЕ', "link" => Yii::app()->createUrl('house'));
    $links []= array("text" => 'ДИЗАЙН ПРОЕКТИРОВАНИЕ ИНТЕРЬЕРОВ ЗАГОРОДНЫХ ДОМОВ И КОТТЕДЖЕЙ', "link" => Yii::app()->createUrl('house'));
    $links []= array("text" => 'ДИЗАЙН ПРОЕКТИРОВАНИЕ ИНТЕРЬЕРОВ КВАРТИР', "link" => Yii::app()->createUrl('flat'), "has_br" => true);
    $links []= array("text" => 'ДИЗАЙН ПРОЕКТИРОВАНИЕ ОБЩЕСТВЕННЫХ ИНТЕРЬЕРОВ И ОФИСОВ', "link" => Yii::app()->createUrl('society'));
    $links []= array("text" => 'РАЗРАБОТКА ФИРМЕННОГО СТИЛЯ', "link" => Yii::app()->createUrl('corp_style'));

    $s = '';
    $sep = ' / ';
    foreach($links as $row) {
        $br = $sep;

        if (!empty($row['has_br'])) {
            $br = '<br />';
        }

        $s .= CHTML::link(mb_strtoupper($row['text'], 'UTF8'), $row['link'], array('style' => 'font-size:11px; font-weight: bold; color:white; text-decoration:none;')) . $br;
    }
    $s = rtrim ($s, $sep);
?>

<div style="color:white; height: 40px; width: 100%; background-color: black; text-align: center;" >
    <?php echo $s; ?>
</div>

<div class="l-wrapper-loader">
	<div class="loader">
	   <img class="big_logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_big.png" alt="Шар" width="500" height="500"  />
	   <div class="language">
	      <a href="<?php echo Yii::app()->request->baseUrl; ?>/main/lang/ru">Русский</a>
		  <a href="<?php echo Yii::app()->request->baseUrl; ?>/main/lang/en">English</a>
	   </div>
	</div>
    <div class="about_new">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_small.png" alt="Шар" width="222" height="15"  />
    </div>
</div><!-- .l-wrapper -->

<div class="metrika" >
    <?php include "ya.metrika.php"; ?>
</div>

<?php  $this->widget('CFixPng', array()); ?>

</body>
</html>