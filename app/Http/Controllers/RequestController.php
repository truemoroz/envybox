<?php

namespace App\Http\Controllers;
// namespace App\FactoryMethod;

use Illuminate\Http\Request;
use App\StorageController;
use App\fileStorageController;


class RequestController extends Controller
{
    public function index()
    {
        echo 'Hello world!';
        return view('welcome.blade');
    }

    public function getPlaces()
    {

        // return response()->json(['mysql', 'file']);
        return response()->json(StorageController::$types);
        // return json_encode(['mysql', 'file']);
    }

    public function saveRequest(StorageController $controller, $content)
    {
        $controller->save($content);
    }

    public function saveRequestAction(Request $request)
    {
        $content['name'] = $request->name;
        $content['phone'] = $request->phone;
        $content['text'] = $request->text;
        $className = 'App\fileStorageController';
        $class = new $className;

        $this->saveRequest($class, $content);
        return true;
    }

}
