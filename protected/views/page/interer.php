<script type="text/javascript">
    gallery_init();
</script>
<div class="menu-hline"><h1 class="g-fleft"><?php echo CHtml::link($article->header, Yii::app()->createUrl('/page/intererAlbum', array('type' => $type, 'lang' => $article->lang))); ?></h1>
    <?php if (!Yii::app()->user->isGuest) {
        echo ' ' . CHtml::link('редактировать', '/article/update/id/' . $article->id . '/' . '?returnUrl=' . $returnUrl, array('class'=>'link_article_edit'));
    } ?>
    <?php if (isset($activePage)) { ?>
    <div class="g-fleft" >
        <?php
//            $s = '';
//            $sep = ' | ' . PHP_EOL;
//
//            for($i=1;$i<=$countPage;$i++) {
//                $class = $i == $activePage ?  'selected' : '';
//
//                $s .= CHtml::link($i, '/page/interer/activePage/' . $i . '/type/' . $type . '/lang/' . $article->lang, array('class' => $class)) . $sep;
//            }
//            echo rtrim($s, $sep);
        ?>
    </div>
    <?php }
    echo CHtml::link(Yii::t('app', 'link_home'), Yii::app()->createUrl('/main'), array('class' => 'g-fright home'));
    ?>
</div>
<?php  $this->widget('CGallery', array('path' => $path, 'files' => $files));
?>