<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index' , compact('users'));
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.edit' , compact('user' , 'roles' , 'permissions'));
    }

    public function update(Request $request , User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $user->syncRoles($request->role);

            $permissions = $request->except('_token' , 'email' , 'role' , 'name' , '_method' );
            $user->syncPermissions($permissions);


            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            alert()->error($exception->getMessage() , 'مشکل در ویرایش نقش')->persistent('حله');
            return redirect()->back();
        }
        alert()->success('کاربر مورد نظر ویرایش شد' , 'با تشکر');
        return redirect()->route('admin.users.index');
    }
}
