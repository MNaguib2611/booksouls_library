<?php
    namespace App\Http\Controllers\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\User;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;
    use App\Http\Requests\UserRequest;
    use Hash;

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
        public function update(UserRequest $request, User $user)
        {
            $requestData=array_filter($request->all());
            if ($request->hasFile('avatar')) {
                $imageName = time().'.'.$request->avatar->extension();  
                $request->avatar->move(public_path('imgs/users'), $imageName);
                $requestData['avatar'] = asset('/imgs/users').'/'.$imageName;
            }
            if($request->password !=""){
                //hash the password
                $requestData['password']=Hash::make($requestData['password']);
            }
            $user->update($requestData);
            return back()->with('status',"Profile updated successfully");
        }
    }