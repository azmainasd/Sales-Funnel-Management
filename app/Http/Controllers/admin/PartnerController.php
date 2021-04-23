<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
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
        $partners = Partner::orderBy('active','DESC')->get();
        return view('admin.partner.index',compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create');
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
            'name' => 'required|min:3|unique:partners'
        ]);
        $partner = new Partner;
        $partner->name = $request->name;
        $partner->active = $request->active;
        $partner->save();
        return redirect(route('partner.index'));
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
        $partner = Partner::find($id);
        return view('admin.partner.edit',compact('partner'));
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
        $partner = Partner::find($id);
        $partner->name = $request->name;
        $partner->active = $request->active;
        $partner->save();
        return redirect(route('partner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner::destroy(array('id',$id));
        return redirect()->back();
    }
}
