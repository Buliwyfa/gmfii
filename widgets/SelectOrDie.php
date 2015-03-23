<?php

/**
* Wrapper Widget to use jQuery Select2 in Yii application.
*
* @author Tonin R. Bolzan <admin@tonybolzan.com>
* @copyright Copyright &copy; 2013 tonybolzan.com
* @package extensions
* @subpackage select2
* @license http://www.opensource.org/licenses/mit-license.php MIT License
* @version 3.4.3 rev.0
*
* @see https://github.com/ivaynberg/select2 jQuery Select2
*/
class SelectOrDie extends CInputWidget
{

    /** @var string Path to assets directory published in init() */
    private $assetsDir;

    /** @var array Chosen script settings passed to $.fn.chosen() */
    private $settings = array();

    /** @var bool Multiple or single item should be selected */
    public $placeholderOption = false;

    public $cycle = false;
    public $links = false;
    public $linksExternal = false;

    /** @var array See CHtml::listData() */
    public $data;

    /** Publish assets and set default values for properties */
    public function init()
    {
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);

        if ($this->placeholderOption) {
            $this->htmlOptions['placeholderOption'] = true;
        } elseif (isset($this->htmlOptions['placeholderOption'])) {
            $this->placeholderOption = true;
        }
        if ($this->cycle) {
            $this->htmlOptions['cycle'] = true;
        } elseif (isset($this->htmlOptions['cycle'])) {
            $this->cycle = true;
        }
        if ($this->links) {
            $this->htmlOptions['links'] = true;
        } elseif (isset($this->htmlOptions['links'])) {
            $this->links = true;
        }
        if ($this->linksExternal) {
            $this->htmlOptions['linksExternal'] = true;
        } elseif (isset($this->htmlOptions['linksExternal'])) {
            $this->linksExternal = true;
        }

        if (isset($this->htmlOptions['customID'])) {
            $this->settings['customID'] = $this->htmlOptions['customID'];
        } elseif (isset($this->htmlOptions['customID'])) {
            $this->settings['customID'] = $this->htmlOptions['data-custom-id'];
        }
        if (isset($this->htmlOptions['customClass'])) {
            $this->settings['customClass'] = $this->htmlOptions['customClass'];
        } elseif (isset($this->htmlOptions['customClass'])) {
            $this->settings['customClass'] = $this->htmlOptions['data-custom-class'];
        }
        if (isset($this->htmlOptions['placeholder'])) {
            $this->settings['placeholder'] = $this->htmlOptions['placeholder'];
        } elseif (isset($this->htmlOptions['data-placeholder'])) {
            $this->settings['placeholder'] = $this->htmlOptions['data-placeholder'];
        }


        if (isset($this->htmlOptions['prefix'])) {
            $this->settings['prefix'] = $this->htmlOptions['prefix'];
        } elseif (isset($this->htmlOptions['prefix'])) {
            $this->settings['prefix'] = $this->htmlOptions['data-prefix'];
        }
        if (isset($this->htmlOptions['size'])) {
            $this->settings['size'] = $this->htmlOptions['size'];
        } elseif (isset($this->htmlOptions['size'])) {
            $this->settings['size'] = $this->htmlOptions['data-size'];
        }
        if (isset($this->htmlOptions['tabindex'])) {
            $this->settings['tabindex'] = $this->htmlOptions['tabindex'];
        } elseif (isset($this->htmlOptions['tabindex'])) {
            $this->settings['tabindex'] = $this->htmlOptions['data-tabindex'];
        }
    }

    /** Render widget html and register client scripts */
    public function run()
    {
        list($name, $id) = $this->resolveNameID();

        if (isset($this->htmlOptions['id'])) {
            $id = $this->htmlOptions['id'];
        } else {
            $this->htmlOptions['id'] = $id;
        }

        if (isset($this->htmlOptions['name'])) {
            $name = $this->htmlOptions['name'];
        }

        if (isset($this->settings['ajax'])) {
            if (isset($this->model)) {
                echo CHtml::textField($name, $this->model->{$this->attribute}, $this->htmlOptions);
            } else {
                echo CHtml::textField($name, $this->value, $this->htmlOptions);
            }
        } else {
            if (isset($this->model)) {
                echo CHtml::dropDownList($name, $this->model->{$this->attribute}, $this->data, $this->htmlOptions);
            } else {
                echo CHtml::dropDownList($name, $this->value, $this->data, $this->htmlOptions);
            }
        }

        $this->registerScripts($id);
    }

    /** Register client scripts */
    private function registerScripts($id)
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        $cs->registerCssFile($this->assetsDir . '/css/selectordie.css');
        $cs->registerScriptFile($this->assetsDir . '/js/plugins/selectordie.js');

        $settings = CJavaScript::encode($this->settings);
        $cs->registerScript("{$id}_selectOrDie", "$('#{$id}').selectOrDie({$settings});");
    }

    public static function dropDownList($name, $select, $data, $htmlOptions = array())
    {
        return Yii::app()->getController()->widget(__CLASS__, array(
        'name' => $name,
        'value' => $select,
        'data' => $data,
        'htmlOptions' => $htmlOptions,
        ), true);
    }

    public static function activeDropDownList($model, $attribute, $data, $htmlOptions = array())
    {
        return self::dropDownList(CHtml::activeName($model, $attribute), CHtml::value($model, $attribute), $data, $htmlOptions);
    }


}
