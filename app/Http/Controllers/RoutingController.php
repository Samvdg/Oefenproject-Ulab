<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class RoutingController extends BaseController
{
    public function dynamic(Request $request)
    {
        // Start of the controller location string and get the request segments
        $controller = '\App\Http\Controllers\\';
        $seg = request()->segments();
        // Check if the given URI has enough segments. If not, return an error
        if(count($seg) < 2) abort(404);

        // Concatinate the controller string with the first 2 segments of the URI
        $controller .= ucfirst($seg[0]) . '\\' . ucfirst($seg[1]) . 'Controller';

        // Check if generated class even exists. If not return an error
        if (class_exists($controller)) $controller =  new $controller;
        else abort(404);

        switch (request()->method())
        {
            case 'GET':

                // if there are only 2 segments on a get, it's the index.
                if (count($seg) < 3) return $controller->index();

                // in case of 3 segments, the 3rd segment will be the id of an object
                elseif (count($seg) == 3) {
                    if(method_exists($controller, 'show')) return $controller->show($seg[2]);
                    else abort(404, 'Method "show" does not exist in given class');
                }

                // incase of more segments, 4 to be exact, it will be edit or a different function defined in a controller
                elseif (count($seg) > 3)
                {
                    // If someone wants to go back, go back to the index of the object
                    if ($seg[3] == "back") return redirect("$seg[0]/$seg[1]");
                    else return $controller->{$seg[3]}($seg[2]);
                }

                // I have no clue how you would get to this point but if you do you deserve a cookie
                else return abort(404);

            case 'POST':
                // If the request is a post with less then 3 segments, its a create
                if (count($seg) < 3) return $controller->store($request);

                // Post with 3 items most likely means a delete
                elseif (count($seg) == 3) return $controller->destroy($seg[2]);

                // Incase of more than 3 segments, there is most likely a custom function in the controller
                elseif (count($seg) > 3) return $controller->{$seg[3]}(request(),$seg[2]);

                // Very hard to get to 404
                else abort(404);
        }

        return  abort(404);
    }
}
