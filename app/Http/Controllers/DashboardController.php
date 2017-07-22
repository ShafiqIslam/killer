<?php namespace App\Http\Controllers;

use App\Death;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deaths = Death::all();
        return view('dashboard', compact('deaths'));
    }

    public function storeDeath(Request $request)
    {
        Death::create($request->all());
        return redirect()->back();
    }

    public function updateDeath(Request $request, Death $death)
    {
        $death->update($request->all());
        return redirect()->back();
    }
}
