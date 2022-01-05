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

    private function transformer($key)
    {
        return trans(request()->path().".$key");
    }

}
