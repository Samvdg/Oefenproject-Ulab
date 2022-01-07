<?php

namespace App\Lib\Twigbridge;

use Illuminate\Support\Facades\URL;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extensions extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('__', function($key) {return $this->transformer($key);}),
            new TwigFunction('replace', function($string, $regex, $replacement = '') {return $this->replace($string, $regex, $replacement = '');}),

        ];
    }

    /**
     * @param $key
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     *
     * This function gets the translation of certain scentences.
     * The translations are stored in a specific folder structure based on the current route
     * Because of this, to get the correct translation, we combine the route and the key of the word/sentence that needs to be translated
     *
     */
    private function transformer($key)
    {
        $req = implode('/',array_slice(request()->segments(),0,2));
        return trans("$req.$key");
    }

    private function replace($string, $regex, $replacement = '')
    {
        return preg_replace($regex, '', $string);
    }

}
