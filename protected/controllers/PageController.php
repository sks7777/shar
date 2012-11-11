<?php

class PageController extends Controller
{
    public $layout='//layouts/layout_index';

    public $pageTextInfo;
    public $pageKeywords;

    protected function beforeAction($action) {

        $action = $this->action->getId();

        $basePath = Yii::getPathOfAlias('webroot.js');
        $baseUrlJs = Yii::app()->getAssetManager()->publish($basePath, true, -1, YII_DEBUG);

        if (!in_array($action, array('index', 'main', 'price', 'contacts', 'partners')) ) {

            Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/jquery.ad-gallery/jquery.ad-gallery.js', CClientScript::POS_BEGIN);
            Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/gallery_init.js', CClientScript::POS_BEGIN);

            Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/jquery.lightbox/js/jquery.lightbox-0.5.pack.js', CClientScript::POS_END);
            Yii::app()->clientScript->registerCssFile($baseUrlJs . '/jquery.lightbox/css/jquery.lightbox-0.5.css', CClientScript::POS_END);

            Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/lightbox_init.js', CClientScript::POS_END);

        } else if ($action == 'main') {
            Yii::app()->clientScript->registerScriptFile($baseUrlJs . '/image_resizer.js', CClientScript::POS_END);
        }

   		return true;
   	}

	public function actionIndex() {
        $this->layout = '//layouts/index_page';
        $this->pageTitle = '';

		$this->render('index');
	}

    public function actionMain() {
        $this->pageTitle = '';

        $this->render('main');
    }

    public function actionInterer($type = 'flat', $activePage = 1) {
        $returnUrl = '/page/interer/activePage/' . $activePage . '/type/' . $type;
        $lang = Yii::app()->getLanguage();

        $code = 'interer_' . $type;
        $article = CArticle::model()->findByAttributes(array('code' => $code, 'lang' => $lang));

        if ($article == false) {    $this->redirect('/main');   }

        $this->pageTitle = !empty($article->title) ? $article->title : $article->header;
        $this->pageKeywords = $article->keyword;

        $articleHeader = $article->header;

        $subarticle = CArticle::model()->findByAttributes(array('parent_id' => $article->id, 'code' => $activePage, 'lang' => $lang));
        if ($subarticle == false) {    $this->redirect('/main');   }

        $this->pageTextInfo = $subarticle->descr;
        //print_r($this->pageTextInfo);
        $countPage = count($article->subarticles);

        $photos = CPhoto::model()->findAllByAttributes(array('article_id' => $subarticle->id));
        //print_r(count($photos)); die;
        if ($activePage > $countPage) {
            $activePage = 1;
        }

        $path = "/images/articles/{$article->code}/$activePage/";
        //print_r($path); die;
        $this->render('interer', array(
              'article' => $article,
              'articleHeader' => $articleHeader,
              'returnUrl' => $returnUrl,
              'type' => $type,
              'path' => $path,
              'files' => $photos,
              'activePage' => $activePage,
              'countPage' => $countPage,
              'descr' => $subarticle->descr,
            )
        );
    }

    public function actionGraph($type = 'sign') {
        $returnUrl = '/page/graph/type/' . $type;
        $lang = Yii::app()->getLanguage();

        $code = 'graph_' . $type;
        $article = CArticle::model()->findByAttributes(array('code' => $code, 'lang' => $lang));
        if ($article == false) {    $this->redirect('/main');   }

        $this->pageTitle = !empty($article->title) ? $article->title : $article->header;
        $this->pageKeywords = $article->keyword;
        $articleHeader = $article->header;

        $photos = CPhoto::model()->findAllByAttributes(array('article_id' => $article->id));
        //print_r($photos); die;

        $path = "/images/articles/{$article->code}/";

        $this->render('interer', array(
                                      'article' => $article,
                                      'articleHeader' => $articleHeader,
                                      'returnUrl' => $returnUrl,
                                      'type' => $type,
                                      'path' => $path,
                                      'files' => $photos)
        );
    }


    public function actionPrice() {
        $lang = Yii::app()->getLanguage();
        $this->pageTitle = Yii::t('app', 'page_price');
        //$this->pageTitle = 'Порядок работы и цены';

        $this->render('price-' . $lang, array());
    }

    public function actionContacts() {
        $lang = Yii::app()->getLanguage();
        $this->pageTitle = Yii::t('app', 'page_contacts');

        $this->render('contacts-' . $lang, array());
    }

    public function actionPartners() {
        $lang = Yii::app()->getLanguage();
        $this->pageTitle = Yii::t('app', 'page_partners');

        $this->render('partners-' . $lang, array());
    }

}