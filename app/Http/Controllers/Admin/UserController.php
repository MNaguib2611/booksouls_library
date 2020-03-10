<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::where('isAdmin',0)->where('isActive',1)->paginate(5);
        $users = User::where('isAdmin',0)->paginate(5);

        return view('admin.users.index',["users"=>$users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show',["user"=>$user]);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user)
    {
        $user->delete();
        return back()->with('status','User deleted successfully');
    }
    //downgrade user to a normal user    
    public function upgrade(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index')->with('status',"user was upgraded to an admin successfully");
    }
    public function activate(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index')->with('status',"user was activated successfully");
    }
    public function deactivate(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index')->with('status',"user was deactivated successfully");
    }
}
