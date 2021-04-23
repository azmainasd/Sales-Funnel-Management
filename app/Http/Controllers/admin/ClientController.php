<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
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
        $clients = Client::orderBy('active','DESC')->get();
        return view('admin.client.index',compact('clients'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:clients'
        ]);
        $client = new Client;
        $client->name = $request->name;
        $client->active = $request->active;
        $client->save();
        return redirect(route('client.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin.client.edit',compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->name = $request->name;
        $client->active = $request->active;
        $client->save();
        return redirect(route('client.index'));
    }

    public function destroy($id)
    {
        Client::destroy(array('id',$id));
        return redirect()->back();
    }
}
