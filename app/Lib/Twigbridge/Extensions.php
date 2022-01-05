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
        return trans(request()->path().".$key");
    }

}
