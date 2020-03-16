<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Lease;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Leases = Lease::paginate(18);
        return view('admin.leases.index', compact('Leases'));
    }

  
}
