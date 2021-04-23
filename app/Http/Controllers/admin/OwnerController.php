<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Master-Data-Create|Master-Data-Edit|Master-Data-Delete', ['only' => ['index','show']]);
        $this->middleware('permission:Master-Data-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Master-Data-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Master-Data-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::orderBy('active','DESC')->get();
        return view('admin.owner.index',compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owner.create');
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
            'name' => 'required|min:3|unique:owners'
        ]);
        $owner = new Owner;
        $owner->name = $request->name;
        $owner->active = $request->active;
        $owner->save();
        return redirect(route('owner.index'));
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
        $owner = Owner::find($id);
        return view('admin.owner.edit',compact('owner'));
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
        $owner = Owner::find($id);
        $owner->name = $request->name;
        $owner->active = $request->active;
        $owner->save();
        return redirect(route('owner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Owner::destroy(array('id',$id));
        return redirect()->back();
    }
}
