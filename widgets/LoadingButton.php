<?php

/**
 *
 * @package humhub.modules.gmfu.views
 * @since 0.5
 * @author b3457m0d3
 */
class LoadingButton extends CInputWidget {

    /** @var string Path to assets directory published in init() */
    private $assetsDir;

    public function init() {
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);
    }
    public function run() {
        list($name,$id)=$this->resolveNameID();
        if(isset($this->htmlOptions['id'])) $id=$this->htmlOptions['id']; else $this->htmlOptions['id']=$id;
        if (isset($this->htmlOptions['name'])) $name = $this->htmlOptions['name'];

        echo CHtml::tag(
            'button',
            array(
                'class'=>'ladda-button',
                'data-color'=>'green',
                'data-style'=>'expand-left',
                'name'=>'btnSubmit',
                'type'=>'submit'
            ),
            'Submit'
        );
        $this->registerScripts($id);
    }

    /** Register client scripts */
    private function registerScripts($id)
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        $cs->registerCssFile($this->assetsDir . '/ladda.css');
        $cs->registerScriptFile($this->assetsDir . '/spin.min.js',CClientScript::POS_END);
        $cs->registerScriptFile($this->assetsDir . '/ladda.min.js',CClientScript::POS_END);
        $cs->registerScriptFile($this->assetsDir . '/jquery.ladda.js',CClientScript::POS_END);

        $cs->registerScript("{$id}_ladda", "$( '.ladda-button' ).ladda( 'bind', { timeout: 2000 } );");
    }
}

?>
