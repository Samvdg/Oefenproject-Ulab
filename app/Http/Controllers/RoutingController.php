<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class RoutingController extends BaseController
{
    public function dynamic($uri, Request $request)
    {
        $controller = '\App\Http\Controllers\\';
        $seg = request()->segments();
        $controller .= ucfirst($seg[0]) . '\\' . ucfirst($seg[1]) . 'Controller';
        $controller = new $controller;
//        dd($seg);


        // TODO: Make a switch case for all methods
        switch (request()->method())
        {
            case 'GET':

                // This can probably be simplified?
                // if there are only 2 segments on a get, it's the index.
                if (count($seg) < 3){
                    return $controller->index();
                }

                // in case of 3 segments, the 3rd segment will be the id of an object
                elseif (count($seg) == 3)
                {
                    return $controller->show($seg[2]);
                }

                // incase of more segments, 4 to be exact, it will be edit or a different function defined in a controller
                // maybe check if $seg[3] exists in the given controller?
                elseif (count($seg) > 3)
                {
                    if ($seg[3] == "back") {
                        return redirect("$seg[0]/$seg[1]");
                    }
                    return $controller->{$seg[3]}($seg[2]);
                }
                break;

            case 'POST':
                // If the request is a post with less then 3 segments, its a create
                if (count($seg) < 3){
                    return $controller->store($request);
                }

                // Post with 3 items most likely means a delete
                elseif (count($seg) == 3)
                {
                    return $controller->destroy($seg[2]);
                }

                // i dont think there is going to be urls like this but just incase there is a custom function with a post
                elseif (count($seg) > 3)
                {
                    return $controller->{$seg[3]}(request(),$seg[2]);
                }
                // if there are 3 segments, it is a get for a controller action

                break;

            default:
                echo "No clue where ur goin but it aint the right way";
                break;

        }

        // todo add 404 error handling
        // todo : let comments load out based on the chosen topic. When wanting to go back from the comments, redirect to the topic page.

    }
}