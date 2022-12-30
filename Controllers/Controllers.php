<?php

namespace MF\Controllers;

use MF\cores\Config;

abstract class Controllers
{

    public function render(string $fichier, array $donnees = [])
    {
        extract($donnees); 
        ob_start();
        require_once ROOT . 'Views/' . $fichier . '.php';
        $contents = ob_get_clean();
        return $contents;
    }


    public function renderJson(array $donnees)
    {
        header('Content-Type: application/json');
        $data = json_encode($donnees);
        require_once ROOT . '/tamplates/json.php';
    }

    public static function gToken()
    {
        return sha1("MF" . md5(rand(0, 99999999999999)) . "MF" . rand(0, 99999999999999));
    }

    public function Show()
    {
        $fichier = str_replace('MF\\Controllers\\', '', get_class($this));
        $fichier = str_replace("Controllers", "Views", $fichier);
        return $this->render($fichier);
    }

    function bb_parse($text)
    {
        $text = strip_tags($text);
        $text = strtolower($text);
        // BBcode array
        $find = array(
            '~\[p\](.*?)\[/p\]~s',
            '~\[center\](.*?)\[/center\]~s',
            '~\[b\](.*?)\[/b\]~s',
            '~\[i\](.*?)\[/i\]~s',
            '~\[u\](.*?)\[/u\]~s',
            '~\[quote\]([^"><]*?)\[/quote\]~s',
            '~\[url\]((?:ftp|https?)://[^"><]*?)\[/url\]~s',
            '~\[url=([^"><]*?)\](.*?)\[/url\]~s',
            '~\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
        );
        // HTML tags to replace BBcode
        $replace = array(
            '<p>$1</p>',
            '<div class="justify-content-center text-center">$1</div>',
            '<b>$1</b>',
            '<i>$1</i>',
            '<span style="text-decoration:underline;">$1</span>',
            '<pre>$1</' . 'pre>',
            '<a class="text-decoration-none dwl" href="$1" target="_blank">$1</a><br/>',
            '<a class="text-decoration-none dwl" href="$1" target="_blank">$2</a><br/>',
            '<img class="img-responsive" src="$1" alt="image" /><br/>'
        );
        // Replacing the BBcodes with corresponding HTML tags
        return preg_replace($find, $replace, $text);
    }
}