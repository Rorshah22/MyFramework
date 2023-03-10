<?php

namespace MyProject\Services;


class Parser
{
    private string $url;
    public function __construct(string $url)
    {
        $this->url=$url;
        $this->parser();
    }

    public function getHtml()
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1);
        $result = curl_exec($curl);

        if ($result === false){
            echo 'Ошибка curl'.curl_error($curl);
        }else{
            return $result;
        }
    }

    public function parser()
    {
        include __DIR__.'/../../Lib/simple_html_dom.php';
        $html = new \simple_html_dom();
        $html->load($this->getHtml());
        $collection = $html->find('header.b-main-page-blocks-header-2');
        foreach ($collection as $collectionItem){
            echo '<pre>';
            var_dump($collectionItem);
//            break;
        }
    }

}