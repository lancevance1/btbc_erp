<?php

namespace App\Http\Controllers;

use App\Logbook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $logbooks = Logbook::orderBy('updated_at', 'DESC')->paginate(15);
        return view('logbook.index',compact('logbooks'));
    }
}
