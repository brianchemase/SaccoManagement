<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\SavingsImport;
use App\Exports\SavingsPreferencesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class SavingsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0.01',
            'transaction_type' => 'required|in:deposit,withdrawal',
            'transaction_date' => 'required|date|before_or_equal:today',
            'remarks' => 'nullable|string|max:255',
        ]);

        DB::table('savings')->insert([
            'member_id' => $request->member_id,
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type,
            'transaction_date' => $request->transaction_date,
            'remarks' => $request->remarks,
        ]);

        return back()->with('success', 'Savings transaction recorded successfully.');
    }

    public function statement(Request $request)
    {
        $now = Carbon::now();
        $members = DB::table('members')->orderBy('full_name')->get();
        $savings = collect(); // default empty collection

        $member = null;
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $totalDeposits = 0;
        $totalWithdrawals = 0;
        $currentBalance = 0;

        

        if ($request->member_id) {
            $savings = DB::table('savings')
                ->join('members', 'savings.member_id', '=', 'members.id')
                ->select('savings.*', 'members.full_name', 'members.id', 'members.id_number')
                ->where('savings.member_id', $request->member_id)
                ->when($fromDate, fn($q) => $q->whereDate('transaction_date', '>=', $fromDate))
                ->when($toDate, fn($q) => $q->whereDate('transaction_date', '<=', $toDate))
                ->orderByDesc('savings.transaction_date')
                ->get();
    
            $member = DB::table('members')->where('id', $request->member_id)->first();

            // return $member;

            

                $totalDeposits = DB::table('savings')
                    ->where('member_id', $request->member_id)
                    ->where('transaction_type', 'deposit')
                    ->sum('amount');

                $totalWithdrawals = DB::table('savings')
                    ->where('member_id', $request->member_id)
                    ->where('transaction_type', 'withdrawal')
                    ->sum('amount');

                $currentBalance = $totalDeposits - $totalWithdrawals;
        }

        $data = [
            'now' => $now,
            'pagetitle' => 'Member Savings Statement',
            'members' => $members,
            'savings' => $savings,
            'selected_member' => $request->member_id,
            'member' => $member,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'totalDeposits' => $totalDeposits,
            'totalWithdrawals' => $totalWithdrawals,
            'currentBalance' => $currentBalance,
        ];

        return view('dashboard.savings_statement')->with($data);
    }

    public function tablestatement($memberno)
    {
        $memberData = DB::table('members')->where('id', $memberno)->first();
        $contributions="";
        $Totalcontributions = DB::table('savings')
                    ->where('member_id', $memberno)
                    ->sum('amount');

        $TotalContributions = DB::table('savings')
        ->where('member_id', $memberno)
        ->where('transaction_type', 'deposit')
        ->sum('amount');

        // Total Deposits
        $TotalDeposits = DB::table('savings')
        ->where('member_id', $memberno)
        ->where('transaction_type', 'deposit')
        ->sum('amount');

        // Total Withdrawals
        $TotalWithdrawals = DB::table('savings')
        ->where('member_id', $memberno)
        ->where('transaction_type', 'withdrawal')
        ->sum('amount');

        $totalsavingsbal= $TotalDeposits- $TotalWithdrawals;
                            

            $distinctYears = DB::table('savings')
            ->select(DB::raw('YEAR(transaction_date) as year'))
            ->where('member_id', $memberno)
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $statements = [];

        // Loop through distinct years and fetch sums for each year
        foreach ($distinctYears as $year) {
        $totalSum = DB::table('savings')
            ->select(
                DB::raw('SUM(amount) as total_amount'),
                DB::raw('MONTH(transaction_date) as payment_month')
            )
            ->where('member_id', $memberno)
            ->whereYear('transaction_date', $year)
            ->groupBy(DB::raw('MONTH(transaction_date)'))
            ->orderBy(DB::raw('MONTH(transaction_date)'))
            ->pluck('total_amount', 'payment_month')
            ->toArray();
    
        // Fill missing months with 0
        $statements[$year] = [];
        for ($month = 1; $month <= 12; $month++) {
            $statements[$year][$month] = $totalSum[$month] ?? 0;
        }
        }

        foreach ($distinctYears as $year) {
            $totalSum = DB::table('savings')
                ->select(
                    DB::raw('SUM(amount) as total_amount'),
                    DB::raw('MONTH(transaction_date) as payment_month')
                )
                ->where('member_id', $memberno)
                ->where('transaction_type', 'deposit') // Only deposits
                ->whereYear('transaction_date', $year)
                ->groupBy(DB::raw('MONTH(transaction_date)'))
                ->orderBy(DB::raw('MONTH(transaction_date)'))
                ->pluck('total_amount', 'payment_month')
                ->toArray();
        
            // Fill missing months with 0
            $statements[$year] = [];
            for ($month = 1; $month <= 12; $month++) {
                $statements[$year][$month] = $totalSum[$month] ?? 0;
            }
        }

        

        $data=[
            'contributions' => $contributions,
            'statements' => $statements,
            'memberData' => $memberData,
            'TotalDeposits' => $TotalDeposits,
            'TotalWithdrawals' => $TotalWithdrawals,
            'totalsavingsbal' => $totalsavingsbal,
            'Totalcontributions' => $Totalcontributions,
            

        ];

        //return view('dashboard.reports.savingsstatment')->with($data);

        // $pdf = PDF::loadView('dashone.statement', $data);
        // return $pdf->download('ClientStatement.pdf');
        // return $pdf->stream();


        $pdf = PDF::loadView('dashboard.reports.savingsstatment', $data);
        $pdf->setPaper('L', 'landscape');
                return $pdf->stream();
    }

    public function showUploadForm()
    {
                
        $data = [
            'pagetitle' => 'Member Savings Upload',
            
        ];

        return view('dashboard.uploadsavings')->with($data);
        
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new SavingsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Savings records imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $filePath = public_path('templates/Savings_Sacco_Templete_v1.2.xlsx'); // adjust as needed
        $fileName = 'Savings_Sacco_Templete_v1.2.xlsx';

        if (file_exists($filePath)) {
            return Response::download($filePath, $fileName);
        } else {
            abort(404, 'Template not found.');
        }
    }


    public function savingsetuppage() 
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

        $preferences = DB::table('preferred_savings as ps')
        ->join('members as m', 'm.id', '=', 'ps.member_id')
        ->where('ps.status', 'active')
        ->select('ps.*', 'm.full_name', 'm.email')
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
            'preferences' => $preferences,
            'stations' => "",
            'pagetitle' => "Members Savings Preference",
            'totalSavings' => $totalSavings,
            'totalWithdrawals' => $totalWithdrawals,
            'thisMonthSavings' => $thisMonthSavings,
            'lastMonthSavings' => $lastMonthSavings,
        ];
        return view('dashboard.savings_pref')->with($data);
    }


    public function storepreferences(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'preferred_amount' => 'required|numeric|min:1',
            'effective_from' => 'required|date',
        ]);

        // Check if member already has a preference
        $existing = DB::table('preferred_savings')->where('member_id', $request->member_id)->first();

        if ($existing) {
            //return redirect()->back()->with('error', 'This member already has a savings preference.');
            return back()->with('error', 'This member already has a savings preference.');
        }

        // Inactivate previous
        DB::table('preferred_savings')
            ->where('member_id', $request->member_id)
            ->where('status', 'active')
            ->update(['status' => 'inactive']);

        // Insert new
        DB::table('preferred_savings')->insert([
            'member_id' => $request->member_id,
            'preferred_amount' => $request->preferred_amount,
            'effective_from' => $request->effective_from,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Savings Preference saved successfully.');       
    }

    public function updatepreferences(Request $request, $id)
    {
        $request->validate([
            'preferred_amount' => 'required|numeric|min:1',
            'effective_from' => 'required|date',
        ]);

        DB::table('preferred_savings')->where('id', $id)->update([
            'preferred_amount' => $request->preferred_amount,
            'effective_from' => $request->effective_from,
            'updated_at' => now(),
        ]);
        
        return back()->with('success', 'Savings Preference updated successfully.');

    }

    public function exportPreferencesExcel()
        {
            return Excel::download(new SavingsPreferencesExport, 'savings_preferences.xlsx');
        }


}
