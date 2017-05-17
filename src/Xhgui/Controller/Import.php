<?php

class Xhgui_Controller_Import extends Xhgui_Controller
{
    public function __construct($app)
    {
        $this->_app = $app;
    }

    public function postImport()
    {
        $json = $this->_app->request->getBody();
        $data = json_decode($json, true);

        $container = Xhgui_ServiceContainer::instance();
        $saver = $container['saverMongo'];

        $saver->save($data);

        $this->_template = 'import/success.twig';
    }
}
