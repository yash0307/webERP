<?php
/**
  **Yash Patel
  **/
class LoginController extends BaseController
{
	public function getuser_permission()
	{
		DB::table('permissions')->delete();
		/*$permissions = DB::table('permissions')->get();
		foreach($permissions as $permission)
		{
			$permission->delete();
		}*/
		$users = DB::table('users')->get();
		return View::make('Login_permission.Loginpermission')->with('users', $users);
	}
	public function postpermission_save()
	{
		$users = DB::table('users')->get();
		foreach($users as $user)
		{
			$permissions = new Permission;
			$permissions->username = $user->username;
			$permissions->permission = Input::get('permissions'.$user->username);
			if($permissions->save())
			{
				return View::make('home');
			}
		}
	}
}
