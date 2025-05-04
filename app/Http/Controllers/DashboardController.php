<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function dashboard() 
    {
        
        $contributions="";
        // Count members by status
        $statusCounts = DB::table('members')
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status');

         // Total savings (deposits)
         $totalSavings = DB::table('savings')
         ->where('transaction_type', 'deposit')
         ->sum('amount');

        


        
        $data = [
            'contributions' => $contributions,
            'stations' => "",
            'pagetitle' => "Dashboard Home page",
            'statusCounts' => $statusCounts,
            'totalSavings' => $totalSavings,
        ];
        return view('dashboard.home')->with($data);
    }

    public function members() 
    {
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

    public function loans() 
    {
        $contributions="";

        $loans = DB::table('loans')
            ->join('members', 'loans.member_id', '=', 'members.id')
            ->select('loans.*', 'members.full_name')
            ->orderByDesc('loans.id')
            ->get();

            // Calculate total loans issued (sum of amount_approved)
            $totalLoansIssued = DB::table('loans')
            ->whereNotNull('amount_approved')
            ->sum('amount_approved');

            // Total of loans where status is 'approved'
            $totalApprovedLoans = DB::table('loans')
            ->where('status', 'approved')
            ->whereNotNull('amount_approved')
            ->sum('amount_approved');

             // Total of defaulted loans
            $totalDefaultedLoans = DB::table('loans')
                ->where('status', 'defaulted')
                ->whereNotNull('amount_approved')
                ->sum('amount_approved');

            $totalLoanCount = DB::table('loans')->count(); // Count of all loans issued



        
        $data = [
            'contributions' => $contributions,
            'loans' => $loans,
            'totalLoansIssued' => $totalLoansIssued,
            'totalApprovedLoans' => $totalApprovedLoans,
            'totalDefaultedLoans' => $totalDefaultedLoans,
            'totalLoanCount' => $totalLoanCount,
            'stations' => "",
            'pagetitle' => "Loan Management",
        ];
        return view('dashboard.newloans')->with($data);
    }

    public function savings() 
    {

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
            'now' => $now,
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
        $members = DB::table('members')->select('id', 'full_name')->get();

        $loans = DB::table('loans')
            ->join('members', 'loans.member_id', '=', 'members.id')
            ->select('loans.id', 'loans.loan_type', 'loans.amount_approved', 'members.full_name')
            ->orderBy('loans.id', 'desc')
            ->get();

    
        $data = [
            'members' => $members,
            'loans' => $loans,
            'pagetitle' => "Loan Statement ",
        ];
        return view('dashboard.loan_statement')->with($data);
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
