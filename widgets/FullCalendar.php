<?php

/**
 * HumHub
 * Copyright © 2014 The HumHub Project
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 */

/**
 * A funcional FullCalendar instance in widget form
 *
 * @author b3457m0d3
 */
class FullCalendar extends HWidget
{

    public $canWrite = true;
    public $assets;
    public $enablePackage = false;
    public $loadUrl = "";
    public $createUrl = "";

    public $selectors = [];
    public $filters = [];

    public function init(){
        if(!$this->enablePackage) $this->assets = Yii::app()->assetManager->publish(__DIR__.'/assets');
    }

    public function run(){
        if($this->enablePackage){
            $fullCalPack = array(
                'basePath'=> __DIR__.'/assets',
                'css'     => array( 'fullcalendar/fullcalendar.css' ),
                'js'      => array(
                    'fullcalendar/lib/moment.min.js','fullcalendar/lib/jquery-ui.custom.min.js',
                    'fullcalendar/fullcalendar.min.js','fullcalendar/lang-all.js',
                    'fullcalendar.js'
                ),
                'depends' => array('jquery')
            );
            $this->assets = Yii::app()->clientScript
                ->addPackage('fullCalPack', $fullCalPack)
                ->registerPackage('fullCalPack')
                ->getPackageBaseUrl('fullCalPack');
        } else {
            Yii::app()->clientScript->registerCssFile($this->assets . '/fullcalendar/fullcalendar.css');
            Yii::app()->clientScript->registerCssFile($this->assets . '/fullcalendar/fullcalendar.print.css', 'print');

            Yii::app()->clientScript->registerScriptFile($this->assets . '/fullcalendar/lib/moment.min.js');
            Yii::app()->clientScript->registerScriptFile($this->assets . '/fullcalendar/lib/jquery-ui.custom.min.js');
            Yii::app()->clientScript->registerScriptFile($this->assets . '/fullcalendar/fullcalendar.min.js');
            Yii::app()->clientScript->registerScriptFile($this->assets . '/fullcalendar/lang-all.js');

            Yii::app()->clientScript->registerScriptFile($this->assets . '/fullcalendar.js');
        }


        Yii::app()->clientScript->setJavascriptVariable('fullCalendarCanWrite', $this->canWrite ? 'true' : 'false');
        Yii::app()->clientScript->setJavascriptVariable('fullCalendarTimezone', date_default_timezone_get());
        Yii::app()->clientScript->setJavascriptVariable('fullCalendarLanguage', Yii::app()->language);
        Yii::app()->clientScript->setJavascriptVariable('fullCalendarLoadUrl', $this->loadUrl);
        Yii::app()->clientScript->setJavascriptVariable('fullCalendarCreateUrl', $this->createUrl);

        Yii::app()->clientScript->setJavascriptVariable('fullCalendarSelectors', CHtml::encode(join(",",$this->selectors)));
        Yii::app()->clientScript->setJavascriptVariable('fullCalendarFilters', CHtml::encode(join(",",$this->filters)));


        $this->render('fullcalendar', []);
    }

}

?>
