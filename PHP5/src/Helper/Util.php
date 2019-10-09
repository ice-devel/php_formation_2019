<?php
namespace App\Helper;

use Symfony\Component\Routing\RouterInterface;

class Util
{
    private $router;

    public function __construct(RouterInterface $router=null)
    {
        $this->router = $router;
    }

    public function slugify($string, $delimiter='-') {
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);

        return $clean;
    }

    public function generateUrl() {
        $url = $this->router->generate('user_form_create');
        var_dump($url);exit;
    }
}