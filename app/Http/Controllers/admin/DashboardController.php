<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Model\admin\SalesFunnel;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {  
        //  Local Leads Summary
        $localLeads                 = SalesFunnel::with('solution','industry','client','owner','partner')
                                                ->where([ ['type', 'local'],['state',null] ])
                                                ->get();

        $localHeighProspectLds      = SalesFunnel::whereIn('prospect', ['High','Medium'])
                                                ->where([ ['type', 'local'],['state',null] ])
                                                ->count();

        $lclHeigLeadsAmount         = SalesFunnel::whereIn('prospect', ['High','Medium'])
                                                ->where([ ['type', 'local'],['state',null] ])
                                                ->sum('amount');
        
        $LocalLowProspectLds        = SalesFunnel::where([ ['prospect','Low'],['type', 'local'],['state',null] ])
                                                ->count();

        $lclLowLeadsAmount          = SalesFunnel::where([ ['prospect','Low'],['type', 'local'],['state',null] ])
                                                ->sum('amount');
        
        $LocalSecuredLds            = SalesFunnel::where([ ['type', 'local'],['state',1] ])
                                                ->count();
        $LocalDeletedLds            = SalesFunnel::onlyTrashed()
                                                ->whereNotNull('deleteRemarks')
                                                ->where('type', 'local')
                                                ->count();
        //  Foreign Leads Summary
        $foreignLeads               = SalesFunnel::with('solution','industry','client','owner','partner')
                                                ->where([ ['type', 'foreign'],['state',null] ])
                                                ->get();

        $foreignHeighProspectLds    = SalesFunnel::whereIn('prospect', ['High','Medium'])
                                                ->where([ ['type', 'foreign'],['state',null] ])
                                                ->count();

        $fgnHeigLeadsAmount         = SalesFunnel::whereIn('prospect', ['High','Medium'])
                                                ->where([ ['type', 'foreign'],['state',null] ])
                                                ->sum('amount');

        $foreignLowProspectLds      = SalesFunnel::where([ ['prospect','Low'],['type', 'foreign'],['state',null] ])
                                                ->count();

        $fgnLowLeadsAmount          = SalesFunnel::where([ ['prospect','Low'],['type', 'foreign'],['state',null] ])
                                                ->sum('amount');

        $foreignSecuredLds          = SalesFunnel::where([ ['type', 'foreign'],['state',1] ])
                                                 ->count();
        $foreignDeletedLds          = SalesFunnel::onlyTrashed()
                                                ->whereNotNull('deleteRemarks')
                                                ->where('type', 'foreign')
                                                ->get()
                                                ->count();                                    
        // dd($years);
        return view('admin.dashboard.index',
                     compact('localLeads','localHeighProspectLds','lclHeigLeadsAmount',
                             'LocalLowProspectLds','lclLowLeadsAmount','LocalSecuredLds',
                             'LocalDeletedLds','foreignLeads','foreignHeighProspectLds','fgnHeigLeadsAmount',
                             'foreignLowProspectLds','fgnLowLeadsAmount','foreignSecuredLds','foreignDeletedLds'));
    }

    public function getLocalSecuredLeads(){
        $securedLcl = SalesFunnel::with('solution','industry','client','owner','partner')
                            ->where([ ['type', 'local'],['state',1] ])
                            ->get();
        
        return response($securedLcl);
    }

    public function getForeignSecuredLeads(){
        $securedFgn = SalesFunnel::with('solution','industry','client','owner','partner')
                            ->where([ ['type', 'foreign'],['state',1] ])
                            ->get();
        
        return response($securedFgn);
    }

    public function getLocalDeletedLeads(){
        $deletedLcl = SalesFunnel::onlyTrashed()
                            ->with('solution','industry','client','owner','partner')
                            ->whereNotNull('deleteRemarks')
                            ->where('type', 'local')
                            ->get();
        return response($deletedLcl);
    }

    public function getForeignDeletedLeads(){
        $deletedFgn = SalesFunnel::onlyTrashed()
                            ->with('solution','industry','client','owner','partner')
                            ->whereNotNull('deleteRemarks')
                            ->where('type', 'foreign')
                            ->get();
        
        return response($deletedFgn);
    }

    public function leadDetails($id){
        $funnelLead = salesFunnel::with('solution','industry','client','owner','partner')
                                 ->find($id);                       
        return view('admin.dashboard.leadDetails',compact('funnelLead'));
    }

    public function securedLeadDetails($id){
        $securedLeadDetails = salesFunnel::with('solution','industry','client','owner','partner')
                                 ->find($id);                       
        return view('admin.dashboard.securedLeadDetails',compact('securedLeadDetails'));
    }

    public function deletedLeadDetails($id){
        $deletedLeadDetails = salesFunnel::onlyTrashed()
                                         ->with('solution','industry','client','owner','partner')
                                         ->whereNotNull('deleteRemarks')
                                         ->find($id); 
        //dd($deletedLeadDetails);                                                       
        return view('admin.dashboard.deletedLeadDetails',compact('deletedLeadDetails'));
    }

    public function filterLocalLeadsByDate($startDate,$endDate){
        $filteredData= salesFunnel::with('solution','industry','client','owner','partner')
                                  ->where('type', 'local')
                                  ->whereBetween('closingDate', [$startDate, $endDate])
                                  ->orderBy('closingDate','ASC')
                                  ->get();
                     
         //dd($startDate,$endDate);                                                       
        return response($filteredData);
    }

    public function filterForeignLeadsByDate($startDate,$endDate){
        $filteredData= salesFunnel::with('solution','industry','client','owner','partner')
                                  ->where('type', 'foreign')
                                  ->whereBetween('closingDate', [$startDate, $endDate])
                                  ->orderBy('closingDate','ASC')
                                  ->get();
                     
         //dd($startDate,$endDate);                                                       
        return response($filteredData);
    }
}
