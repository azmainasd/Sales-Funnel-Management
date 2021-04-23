<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\admin\Solution;
use App\Http\Controllers\Controller;

class SolutionController extends Controller
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
        $solutions = Solution::orderBy('active','DESC')->get();
        return view('admin.solution.index',compact('solutions'));
    }

    public function create()
    {
        return view('admin.solution.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:solutions'
        ]);
        $solution = new Solution;
        $solution->name = $request->name;
        $solution->active = $request->active;
        $solution->save();
        return redirect(route('solution.index'));
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $solution = Solution::find($id);
        return view('admin.solution.edit',compact('solution'));
    }

    public function update(Request $request, $id)
    {
        $solution = Solution::find($id);
        $solution->name = $request->name;
        $solution->active = $request->active;
        $solution->save();
        return redirect(route('solution.index'));
    }

    public function destroy($id)
    {
        Solution::destroy(array('id',$id));
        return redirect()->back();
    }
}
