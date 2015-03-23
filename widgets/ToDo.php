<?php

/**
 * Todo list widget.
 *
 * @author b3457m0d3
 * @copyright Copyright &copy; 2015 GrayMatterForge.net
 * @package gmfii.widgets
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 *
 */
class ToDo extends HWidget
{

    /** @var string Path to assets directory published in init() */
    private $assetsDir;

    /** Publish assets  */
    public function init(){
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);

    }

    /** Render widget html and register client scripts */
    public function run(){
        $this->registerScripts();
        $this->render('todo');
    }

    /** Register client scripts */
    private function registerScripts(){
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $end = CClientScript::POS_END;
        $cs->registerCssFile($this->assetsDir .  '/css/base.css');
        $cs->registerCssFile($this->assetsDir .  '/css/index.css');
        $cs->registerScriptFile($this->assetsDir .  '/js/base.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/libs/underscore.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/libs/backbone.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/plugins/backbone.localStorage.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/models/todo.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/collections/todos.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/views/todo-view.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/views/app-view.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/routers/router.js',$end);
        $cs->registerScriptFile($this->assetsDir .  '/js/app.js',$end);

    }



}
