<?php

namespace App\Http\Controllers\admin;
use Auth;
use App\Model\admin\Owner;
use App\Model\admin\Client;
use App\Model\admin\Partner;
use Illuminate\Http\Request;
use App\Model\admin\Industry;
use App\Model\admin\Solution;
use App\Model\admin\SalesFunnel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SalesFunnelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Sales-Funnel-Create|Sales-Funnel-Edit|Sales-Funnel-Delete', ['only' => ['index','show']]);
        $this->middleware('permission:Sales-Funnel-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Sales-Funnel-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Sales-Funnel-Delete', ['only' => ['destroy']]);
    }
    public function index()
    { 
        $localLeads =   SalesFunnel::with('solution','industry','client','owner','partner')
                                    ->orderBy('id','DESC')
                                    ->where([ ['type', 'local'],['state',null] ])
                                    ->get(); 

        $foreignLeads = SalesFunnel::with('solution','industry','client','owner','partner')
                                    ->orderBy('id','DESC')
                                    ->where([ ['type', 'foreign'],['state',null] ])
                                    ->get(); 

        return view('admin.salesFunnel.index',compact('localLeads','foreignLeads'));
    }

    public function create()
    {
        $solutions  = Solution::whereNotNull('active')
                                ->pluck('name','id');
        $industries = Industry::whereNotNull('active')
                                ->pluck('name','id');
        $clients    = Client::whereNotNull('active')
                                ->pluck('name','id');
        $owners     = Owner::whereNotNull('active')
                                ->pluck('name','id');
        $partners   = Partner::whereNotNull('active')
                                ->pluck('name','id');
        return view('admin.salesFunnel.create',compact('solutions','industries','clients','owners','partners'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'solution'       => 'required',
            'industry'       => 'required',
            'client'         => 'required',
            'owner'          => 'required',
            'projectScope'   => 'required|min:3',
            'amount'         => 'required|numeric',
            'prospect'       => 'required',
            'type'           => 'required',
            'contactNumber'  => 'nullable|numeric',
        ]);
        
        $lead = new SalesFunnel;
        $lead->solution_id      = $request->solution;
        $lead->industry_id      = $request->industry;
        $lead->client_id        = $request->client;
        $lead->owner_id         = $request->owner;
        $lead->projectScope     = $request->projectScope;
        $lead->amount           = $request->amount;
        $lead->partner_id       = $request->partner;
        $lead->sponsor          = $request->sponsor;
        $lead->currentStatus    = $request->currentStatus;
        $lead->action           = $request->action;
        $lead->prospect         = $request->prospect;
        $lead->closingDate      = $request->closingDate;
        $lead->remarks          = $request->remarks;
        $lead->ceoRemark        = $request->ceoRemark;
        $lead->contactPerson    = $request->contactPerson;
        $lead->contactNumber    = $request->contactNumber;
        $lead->type             = $request->type;
        $lead->save();
        $request->session()->flash('msg','Data submitted');
        return redirect(route('sales-funnel.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $solutions  = Solution::pluck('name','id');
        $industries = Industry::pluck('name','id');
        $clients    = Client::pluck('name','id');
        $owners     = Owner::pluck('name','id');
        $partners   = Partner::pluck('name','id');
        $lead       = SalesFunnel::with('solution','industry')->find($id); 
        return view('admin.salesFunnel.edit',compact('lead','solutions','industries','clients','owners','partners'));
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $this->validate($request,[
            'solution'       => 'required',
            'industry'       => 'required',
            'client'         => 'required',
            'owner'          => 'required',
            'projectScope'   => 'required|min:3',
            'amount'         => 'required|numeric',
            'prospect'       => 'required',
            'contactNumber'  => 'nullable|numeric',
        ]);
        $lead = SalesFunnel::find($id);
        if($lead->currentStatus == $request->currentStatus){
            $prev = $lead->previousStatus;
        }
        else{
            $prev = $lead->currentStatus;
        }
        $type = $lead->type;
        
        $lead->delete();
        //delete 
        $lead = new SalesFunnel;
        $lead->solution_id     = $request->solution;
        $lead->industry_id     = $request->industry;
        $lead->client_id       = $request->client;
        $lead->owner_id        = $request->owner;
        $lead->projectScope    = $request->projectScope;
        $lead->amount          = $request->amount;
        $lead->partner_id      = $request->partner;
        $lead->sponsor         = $request->sponsor;
        $lead->previousStatus  = $prev;
        $lead->currentStatus   = $request->currentStatus;
        $lead->action          = $request->action;
        $lead->prospect        = $request->prospect;
        $lead->closingDate     = $request->closingDate;
        $lead->remarks         = $request->remarks;
        $lead->ceoRemark       = $request->ceoRemark;
        $lead->contactPerson   = $request->contactPerson;
        $lead->contactNumber   = $request->contactNumber;
        $lead->type            = $type;
        $lead->state           = $request->state;
        $lead->poNumber        = $request->poNumber;
        $lead->poAmount        = $request->poAmount;
        $lead->poDate          = $request->poDate;
        $lead->poExpiryDate    = $request->poExpiryDate;
        $lead->save();
        $request->session()->flash('msg','Data Updated');
        $request->session()->flash('type', $type);
        return redirect(route('sales-funnel.index'));
    }

    public function destroy(Request $request, $id)
    {
        $this->validate($request,[
            'deleteRemarks'       => 'required',
        ]);
        $lead = SalesFunnel::find($id);
        $lead->deleteRemarks = $request->deleteRemarks;
        $lead->save();
        $lead->delete();
        return redirect()->back();
    }
}
