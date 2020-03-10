<?php
    namespace App\Http\Controllers\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\User;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;

    class ProfileController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        // protected function validator(array $data)
        // {
        //     return Validator::make($data, [
        //         'name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //         'password' => ['required', 'string', 'min:8', 'confirmed']
        //     ]);
        // }

        public function edit(User $user)
        {   
            $user = Auth::user();
            return view('user.profile', compact('user'));
        }
        public function update(User $user)
        { 
            if(Auth::user()->email == request('email')) 
            {
                $this->validate(request(), [
                    'name' => 'required',
                    'password' => 'required|min:6|confirmed'
                ]);
                $user->name = request('name');
                $user->password = bcrypt(request('password'));
                $user->save();
                // return back();
                return redirect('/profile')->with('success', 'Profile Updated Successfully !');
            }
            else
            {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'email|required|unique:users,email,'.$this->segment(2),
                    'password' => 'required|min:6|confirmed'
                ]);
                $user->name = request('name');
                $user->email = request('email');
                $user->password = bcrypt(request('password'));
                $user->save();
                // return back();
                return redirect('/profile')->with('success', 'Profile Updated Successfully !');  
            }
        }
    }