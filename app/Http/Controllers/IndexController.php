<?php  
namespace vapj\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * Mostra a view index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.principal');
    }
}
