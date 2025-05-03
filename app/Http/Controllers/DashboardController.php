<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

         // Total savings (deposits)
            $totalSavings = DB::table('savings')
            ->where('transaction_type', 'deposit')
            ->sum('amount');

        // Total withdrawals
        $totalWithdrawals = DB::table('savings')
            ->where('transaction_type', 'withdrawal')
            ->sum('amount');

        // This month's savings
        $thisMonthSavings = DB::table('savings')
            ->where('transaction_type', 'deposit')
            ->whereBetween('transaction_date', [$startOfMonth->toDateString(), $now->toDateString()])
            ->sum('amount');

        // Last month's savings
        $lastMonthSavings = DB::table('savings')
            ->where('transaction_type', 'deposit')
            ->whereBetween('transaction_date', [$startOfLastMonth->toDateString(), $endOfLastMonth->toDateString()])
            ->sum('amount');

        // Load members and savings for the view
        $savings = DB::table('savings')
                    ->join('members', 'savings.member_id', '=', 'members.id')
                    ->select('savings.*', 'members.full_name')
                    ->orderByDesc('savings.id')
                    ->get();




        $contributions="";

        $savings = DB::table('savings')
        ->join('members', 'savings.member_id', '=', 'members.id')
        ->select('savings.*', 'members.full_name')
        ->orderByDesc('savings.id')
        ->get();

        $members = DB::table('members')->orderBy('full_name')->get();

        
        $data = [
            'contributions' => $contributions,
            'savings' => $savings,
            'members' => $members,
            'stations' => "",
            'pagetitle' => "Savings Dashboard",
            'totalSavings' => $totalSavings,
            'totalWithdrawals' => $totalWithdrawals,
            'thisMonthSavings' => $thisMonthSavings,
            'lastMonthSavings' => $lastMonthSavings,
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
