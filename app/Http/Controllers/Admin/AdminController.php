<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\User;
use App\Book;
use App\Lease;
use Hash;
use Auth;
use App\Profit;
class AdminController extends Controller
{
    public function dashboard()
    {
        //get all dates in My format in an array
        $profitDates=[];
        $profitvalues=[];
        $modelProfits=Profit::oldest()->get();
        foreach ($modelProfits as $modelProfit) {
           $profitDates[]  =($modelProfit->created_at->format('My'));
           $profitvalues[] =$modelProfit->profit;
        }
        $booksCategory=[];
        $booksCountBCategory=[];
        $books=Book::with('category')->get()->groupBy('category.name');
        foreach ($books as $category =>$bookCategories) {
            if ($category==null) {
                $category="other";
            }
            $booksCategory[]  =$category;
            $booksCountBCategory[] =count($bookCategories);
        }
        $leasesCategory=[];
        $leaseCountBCategory=[];
        $Leases=Lease::with('book.category')->withTrashed()->get()->groupBy('book.category.name');
        foreach ($Leases as $category =>$LeaseCategories) {
            if ($category==null) {
                $category="other";
            }
            $leasesCategory[]  =$category;
            $leaseCountBCategory[] =count($LeaseCategories);
        }

        $users = User::where('isAdmin',0)->where('isActive',1)->count();
        $Admins = User::where('isAdmin',1)->where('isActive',1)->count();
        $Books = Book::count();
        $leases = Lease::withTrashed()->count();
        $mostRentedBook=Lease::select('book_id')
        ->groupBy('book_id')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->with('book')->first();
        $latestLeases=Lease::latest()->take(5)->get();
        return view('admin.dashboard',[
                'profitDates'=>json_encode($profitDates),
                'profitvalues'=>json_encode($profitvalues),
                'booksCategory'=>json_encode($booksCategory),
                'booksCountBCategory'=>json_encode($booksCountBCategory),
                'leasesCategory'  =>json_encode($leasesCategory),
                'leaseCountBCategory' =>json_encode($leaseCountBCategory),
                'users' => $users,
                'Admins' => $Admins ,
                'Books' => $Books,
                'leases' => $leases,
                'mostRentedBook'=>$mostRentedBook,
                'latestLeases' =>$latestLeases
            ]);
    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admins = User::where('isAdmin',1)->where('isActive',1)->paginate(5);
        return view('admin.admins.index',["admins"=>$admins]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('admin.admins.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {

        //add isAdmin to the request
        $request->request->add(['isAdmin' => 1]);

        
        $requestData = $request->all();

        if ($request->hasFile('avatar')) {
             //upload the image to the the server
            $imageName = time().'.'.$request->avatar->extension();  
            $request->avatar->move(public_path('imgs/admins'), $imageName);
            //change the value of avatar to the new random image.name
            $requestData['avatar'] = asset('/imgs/admins').'/'.$imageName;
        }else {
            $requestData['avatar']= asset("/imgs/users/avatar.png");
        }
       

        

        //hash the password
        $requestData['password']=Hash::make($requestData['password']);
        //create the user ;)
        User::create($requestData);

        return redirect()->route('admins.index')->with('status',"Admin added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        return view('admin.admins.edit',["admin"=>$admin]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.admins.edit',["admin"=>$admin]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, User $admin)
    {
        $requestData=array_filter($request->all());
        if ($request->hasFile('avatar')) {
            $imageName = time().'.'.$request->avatar->extension();  
            $request->avatar->move(public_path('imgs/admins'), $imageName);
            $requestData['avatar'] = asset('/imgs/admins').'/'.$imageName;
        }
        if($request->password !=""){
            //hash the password
            $requestData['password']=Hash::make($requestData['password']);
        }
        $admin->update($requestData);
        return back()->with('status',"Admin updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $adminsCount=User::where('isAdmin',1)->where("isActive",1)->count();
            if ($adminsCount < 2) {  //admin cant delete themselves but still;
                return back()->withErrors("At least one Admin should exist at all times ");
            }elseif (Auth::id() == $admin->id) {
                return back()->withErrors("You can't delete yourself");
            } 
            $admin->delete();
            return redirect()->route('admins.index')->with('status','Admin deleted successfully');
       
    }

//downgrade admin to a normal user    
    public function downgrade(Request $request, User $admin)
    {
       
        if (Auth::id() == $admin->id) {
            return back()->withErrors("You can't downgrade yourself");
        } 
        $admin->update($request->all());
        return redirect()->route('admins.index')->with('status',"Admin was downgraded to a normal user successfully");
    }
}
