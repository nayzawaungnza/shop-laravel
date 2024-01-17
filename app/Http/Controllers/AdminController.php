<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //password change
    public function passwordchange(){
        return view('admin.account.change-password');
    }

    //password store
    public function passwordchangestore(Request $request){


        //dd($request->all());

        $this->passwordValidationCheck($request);

        if(Hash::check($request->oldPassword, Auth()->user()->password)) {

            if(!Hash::check($request->newPassword, Auth()->user()->password)):
                User::where('id',Auth()->user()->id)->update([
                    'password' => Hash::make($request->newPassword),
                ]);
                session()->flash('success','Password updated successfully!');
                return redirect()->route('auth#login');
            else:
                session()->flash('message','New password can not be the old password!');
                return redirect()->route('admin#passwordchange');
            endif;

        }else{
            session()->flash('message','Old password does not matched!');
            return redirect()->route('admin#passwordchange');
        }

    }

    //profile
    public function profile(){
        return view('admin.account.profile');
    }

    //edit profile
    public function editprofile(){
        return view('admin.account.edit-profile');
    }

    //update profile
    public function updateprofile(Request $request){


       $data = $this->getProfileData($request);

       if ($request->hasFile('image')) {
            $user = User::find(Auth::user()->id);

            if($user->image != null ):
                Storage::delete('public/'.$user->image);
            endif;
            // Get the uploaded file
            $profileImage = $request->file('image');
            // Get the original file name
            $originalName = uniqid().$profileImage->getClientOriginalName();
            $profileImage->StoreAs('public',$originalName);
            $data['image'] = $originalName;

       }

       User::where('id',Auth::user()->id)->update($data);

       return redirect()->route('admin#profile')->with(['update'=>'Your profile has been updated.']);
    }

    public function list(){
        $admins = User::when(request('key'),function($query){
                            $query->orwhere('name','like','%'. request('key').'%')
                                  ->orwhere('email','like','%'. request('key').'%')
                                  ->orwhere('phone','like','%'. request('key').'%')
                                  ->orwhere('address','like','%'. request('key').'%')
                                  ->orwhere('gender','like','%'. request('key').'%');
                            })
                        ->where('role','admin')
                        ->orderBy('created_at','desc')
                        ->paginate(5);
                $admins->appends(request()->all());
        //dd($admins);
        return view('admin.account.list',compact('admins'));
    }

    public function changerole($id){
        $admin = User::where('id',$id)->first();
        return view('admin.account.change-role',compact('admin'));
    }

    public function changerolestore($id,Request $request){
       // dd($request->all());
        Validator::make($request->all(),[
            'selectRole' => 'required',
        ],
        [])->validate();

        $role = ['role' =>$request->selectRole];
        //dd($role);
        User::where('id',$id)->update($role);
        return redirect()->route('admin#list')->with(['update'=>'Account Role has been changed.']);


    }
    public function delete($id){
        if(Auth::user()->id == $id):
            return redirect()->route('admin#list')->with(['delete'=>'Your Account has not been deleted yourself.']);
        endif;
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['delete'=>'Account has been deleted.']);
    }
    //validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|different:oldPassword',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ],
        [])->validate();
    }

    private function getProfileData($request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
            'phone' => ['required'],
            'address' => ['required'],
            'gender' => ['required', 'in:male,female,other'], // Add validation rule for gender
            'image' => ['mimes:jpeg,png,gif,jpg','file','max:2048'],

        ])->validate();

        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }
}
