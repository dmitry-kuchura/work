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
        '/web/css/bootstrap/bootstrap-3.3.7.css',
        '/web/css/custom.css',
        '/web/css/bootstrap/components.css',
    ];

    /**
     * included JavaScript files
     *
     * @var array
     */
    public $js = [
        '/web/js/jquery/jquery-2.2.4.js',
        '/web/js/bootstrap/bootstrap-3.3.7.js',
        '/web/js/custom.js',
        '/web/js/app.min.js',
        '/web/js/layout.min.js',
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