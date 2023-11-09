<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\User;
use Image;

class UserController extends Controller
{

	public function view(){
        $viewUser=User::all(); //generate SQL select * from categories
        Return view('showUser')->with('users',$viewUser);
    }

	function index(){

        return view('dashboards.users.index');
    }

	function profile(){
        return view('dashboards.users.profile', array('user' => Auth::user()) );
       }


	   function help(){
		return view('dashboards.users.help');
	}


	function updateInfo(Request $request){

		$validator = \Validator::make($request->all(),[
			'name'=>'required',
			'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
			'gender'=>'required',
		]);

		if(!$validator->passes()){
			return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
		}else{
			 $query = User::find(Auth::user()->id)->update([
				  'name'=>$request->name,
				  'email'=>$request->email,
				  'gender'=>$request->gender,
			 ]);

			 if(!$query){
				 return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
			 }else{
				 return response()->json(['status'=>1,'msg'=>'Your profile info has been update successfuly.']);
			 }
		}
}

     function updateAvatar(Request $request){

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('dashboards.users.profile');

    }


	function changePassword(Request $request){
		//Validate form
		$validator = \Validator::make($request->all(),[
			'oldpassword'=>[
				'required', function($attribute, $value, $fail){
					if( !\Hash::check($value, Auth::user()->password) ){
						return $fail(__('The current password is incorrect'));
					}
				},
				'min:8',
				'max:30'
			 ],
			 'newpassword'=>'required|min:8|max:30',
			 'cnewpassword'=>'required|same:newpassword'
		 ],[
			 'oldpassword.required'=>'Enter your current password',
			 'oldpassword.min'=>'Old password must have atleast 8 characters',
			 'oldpassword.max'=>'Old password must not be greater than 30 characters',
			 'newpassword.required'=>'Enter new password',
			 'newpassword.min'=>'New password must have atleast 8 characters',
			 'newpassword.max'=>'New password must not be greater than 30 characters',
			 'cnewpassword.required'=>'ReEnter your new password',
			 'cnewpassword.same'=>'New password and Confirm new password must match'
		 ]);

		if( !$validator->passes() ){
			return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
		}else{

		 $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

		 if( !$update ){
			 return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
		 }else{
			 return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
		 }
		}
	}


}