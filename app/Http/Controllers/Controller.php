<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function routing($x = '')
    {

        if(!$x)
        {
            return redirect('review/comments');
        }

        // TODO: Make a switch case for all methods
        switch (request()->method())
        {
            case 'GET':
                $req = request()->segments();
                $view = implode('.', $req);
                return view($view);

            case 'POST':
                //
                break;

            default:
                echo "No clue where ur goin but it aint the right way";
                break;

        }

    }
}
