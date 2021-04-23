<?php

namespace App\Http\Controllers\admin;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:User-Create|User-Edit|User-Delete', ['only' => ['index','show']]);
        $this->middleware('permission:User-Create', ['only' => ['create','store']]);
        $this->middleware('permission:User-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:User-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $users = User::whereHas('roles', function($q)
                        {
                            $q->where('id','!=', 1);                       
                        })
                        ->get();
        return view('admin.user.index',compact('users'));
        //whereNotIn('to_be_used_by_user_id', [2])
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id','!=', 1)
                     ->pluck('name','name');
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request['password'] = bcrypt($request->password);
        $user->active = $request->active;
        $user->save();
       
        $user->assignRole($request->role);
   
        return redirect()
                      ->route('user.index')
                      ->with('message','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('id','!=', 1)->get();
        return view('admin.user.edit',compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $hashedPassword = $user->password;

        if(!empty($request->password)){

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'required|min:6|confirmed',
                'role' => 'required'
            ]);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request['password'] = bcrypt($request->password);
            $user->active = $request->active;
            $user->save();
            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user->assignRole($request->input('role'));

            return redirect()->route('user.index')
                            ->with('success','User updated successfully');
            // if (Hash::check($request->oldPassword , $hashedPassword )) {
                
            // }
            // else{
            //     Session::flash('oldPass', 'Old password mismatch');
            //     return redirect()->back();
            // }
        }
        else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'role' => 'required'
            ]);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->active = $request->active;
            $user->save();
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('role'));
            return redirect()->route('user.index')
                            ->with('success','User updated successfully');
        }

        // $input = $request->all();
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = array_except($input,array('password'));    
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy(array('id',$id));
        return redirect()->back();
    }
}
