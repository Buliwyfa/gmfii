<?php

/**
 *
 * @package humhub.modules.gmfu.views
 * @since 0.5
 * @author b3457m0d3
 */
class Promin extends HWidget {

    public $form;

    public function init(){
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);
    }

    public function run() {

        if (! $this->form instanceof CFormModel) {
            throw new RuntimeException('No valid form available.');
        }
        $this->registerScripts();
        $this->render('promin', array('form'=>$this->form));
    }

    private function registerScripts(){
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile($this->assetsDir .  '/css/promin.css');
        $cs->registerScriptFile($this->assetsDir .  '/js/plugins/jquery.promin.js',$end);


    }
}

?>
