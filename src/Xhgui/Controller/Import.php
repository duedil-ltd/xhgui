<?php

class Xhgui_Controller_Import extends Xhgui_Controller
{
    public function __construct($app)
    {
        $this->_app = $app;
    }

    public function postImport()
    {
        $body = $this->_app->request->getBody();
        $contentEncoding = $this->_app->request->headers->get('CONTENT_ENCODING', '');

        if ($contentEncoding == 'deflate') {
            $json = gzinflate($body);
        } else if ($contentEncoding == 'gzip') {
            $json = gzdecode($body);
        } else {
            $json = $body;
        }

        $data = json_decode($json, true);

        $container = Xhgui_ServiceContainer::instance();
        $saver = $container['saverMongo'];

        $saver->save($data);

        $this->_template = 'import/success.twig';
    }
}
