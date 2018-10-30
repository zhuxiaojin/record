<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $versions = Version::with(['project'])->take(5)->orderBy('is_end', 'asc')->get();
        $my_list = Version::with(['project'])->whereHas('records', function ($query) {
            $query->where('user_id', \Auth::id())->orderBy('current_time', 'desc');
        })->take(5)->orderBy('is_end', 'asc')->get();
        return view('home', compact('versions', 'my_list'));
    }
}
