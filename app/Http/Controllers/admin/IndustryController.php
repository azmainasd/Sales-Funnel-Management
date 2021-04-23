<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\Industry;
use App\Http\Controllers\Controller;

class IndustryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Master-Data-Create|Master-Data-Edit|Master-Data-Delete', ['only' => ['index','show']]);
        $this->middleware('permission:Master-Data-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Master-Data-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Master-Data-Delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $industries = Industry::orderBy('active','DESC')->get();
        return view('admin.industry.index',compact('industries'));
    }

    public function create()
    {
        return view('admin.industry.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:industries'
        ]);
        $industry = new Industry;
        $industry->name = $request->name;
        $industry->active = $request->active;
        $industry->save();
        return redirect(route('industry.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $industry = Industry::find($id);
        return view('admin.industry.edit',compact('industry'));
    }

    public function update(Request $request, $id)
    {
        $industry = Industry::find($id);
        $industry->name = $request->name;
        $industry->active = $request->active;
        $industry->save();
        return redirect(route('industry.index'));
    }

    public function destroy($id)
    {
        Industry::destroy(array('id',$id));
        return redirect()->back();
    }
}
