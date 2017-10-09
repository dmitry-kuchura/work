<?php

/**
 * Class MainController
 */
class MainController extends CController
{
    public $layout = 'main';

    public $menu = [];

    public $breadcrumbs = [];

    /**
     * array for includes css stylesheet files in head
     *
     * @var array
     */
    public $css = [
        '/web/css/components.min.css',
        '/web/css/site.css',
        '/web/css/animate.css',
    ];

    /**
     * included JavaScript files
     *
     * @var array
     */
    public $js = [
        '/web/js/app.js',
    ];

    /**
     * Function for include css stylesheet files in <head></head>
     */
    public function head()
    {
        $css = [];

        foreach ($this->css as $file) {
            $css[] = CHtml::linkTag('stylesheet', null, Yii::app()->request->baseUrl . $file);
        }

        echo implode("\n", $css);
    }

    /**
     * Function for include javascript's files before </body> tag
     */
    public function footer()
    {
        $js = [];

        foreach ($this->js as $file) {
            $js[] = CHtml::scriptFile(Yii::app()->request->baseUrl . $file);
        }

        echo implode("\n", $js);
    }
}