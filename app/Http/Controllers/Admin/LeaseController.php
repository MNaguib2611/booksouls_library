<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Lease;
use DB;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $byStart=1;  //default sorted
        $paginate=1;
        if ($request->has('orderBy')) {
            if ($request->orderBy =="startDate") {
                $Leases = Lease::orderBy('created_at','desc')->paginate(18);
                $byStart=1;
            }elseif ($request->orderBy =="endDate") {
                $Leases = Lease::orderBy('end_date','desc')->paginate(18);
                $byStart=0;
            }
        }elseif ($request->has('search')) {
            // $Leases = Lease::with('user','book')->where('user.id',$request->search)->get();
            $Leases = Lease :: with('user') 
                 ->whereHas('user',function($query) use ($request){
                    return $query ->where('name', 'like', '%' . $request->search . '%');
                 })  ; 
            $Leases->orWhereHas('book', function($query)  use ($request) {
                return  $query->where('title','like', '%' . $request->search . '%');
            }); 
            $Leases=$Leases->get();  
            $paginate=0;
        }else{
            $Leases = Lease::orderBy('created_at','desc')->paginate(18);
        }
        return view('admin.leases.index', compact('Leases','byStart','paginate'));
    }
    public function Completed()
    {

        $Leases = Lease::onlyTrashed()->paginate(18);
        return view('admin.leases.index', compact('Leases'));
    }
  
  
}
