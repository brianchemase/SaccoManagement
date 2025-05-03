<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function dashboard() {
        
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "Dashboard Home page",
        ];
        return view('dashboard.home')->with($data);
    }

    public function members() {
        $contributions="";
        $members = DB::table('members')->get();

             // Count all members
            $totalMembers = DB::table('members')->count();

            // Count members by status
            $statusCounts = DB::table('members')
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

        
        $data = [
            'contributions' => $contributions,
            'members' => $members,
            'totalMembers' => $totalMembers,
            'statusCounts' => $statusCounts,
            'pagetitle' => "Members Management",
        ];
        return view('dashboard.members')->with($data);
    }

    public function loans() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "Loan Management",
        ];
        return view('dashboard.loans')->with($data);
    }

    public function savings() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "",
        ];
        return view('dashboard.savings')->with($data);
    }

    public function savingsStatement() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "",
        ];
        return view('dashboard.savings-statement')->with($data);
    }

    public function loanStatement() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "",
        ];
        return view('dashboard.loan-statement')->with($data);
    }

    public function transactions() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "",
        ];
        return view('dashboard.transactions')->with($data);
    }

    public function reports() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "",
        ];
        return view('dashboard.reports')->with($data);
    }

    public function settings() {
        $contributions="";
        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "",
        ];
        return view('dashboard.settings')->with($data);
    }

}
