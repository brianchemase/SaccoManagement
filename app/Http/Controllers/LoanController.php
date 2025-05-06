<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    //
    public function create() 
    {
        $members = DB::table('members')->select('id', 'full_name')->get();
    
        $data = [
            'members' => $members,
            'pagetitle' => 'Loan Registration',
        ];
    
        return view('dashboard.LoanApplicationForm')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_type' => 'nullable|string|max:50',
            'amount_requested' => 'required|numeric',
            'application_date' => 'required|date',
        ]);

        DB::table('loans')->insert([
            'member_id' => $request->member_id,
            'loan_type' => $request->loan_type,
            'term_months' => $request->term_months,
            'interest_rate' => $request->interest_rate,
            'amount_requested' => $request->amount_requested,
            'amount_approved' => $request->amount_to_repay,
            'monthly_installments' => $request->monthly_installment,
            'status' => "approved",
            'application_date' => $request->application_date,
            'disbursement_date' => now(),
            //'updated_at' => now()
        ]);

        return back()->with('success', 'Loan application submitted.');
        //return redirect()->route('loans.index')->with('success', 'Loan application submitted.');
    }

    public function show($id) 
    {
        $loan = DB::table('loans')
            ->join('members', 'loans.member_id', '=', 'members.id')
            ->select('loans.*', 'members.full_name')
            ->where('loans.id', $id)
            ->first();

            //return $loan;
    
        $data = [
            'loan' => $loan,
            'pagetitle' => 'Loan Details',
        ];
    
        return view('loans.show')->with($data);
    }


    public function LoanRepayment() 
    {
        $members = DB::table('members')->select('id', 'full_name')->get();

        $loans = DB::table('loans')
            ->join('members', 'loans.member_id', '=', 'members.id')
            ->select('loans.id', 'loans.loan_type', 'loans.amount_approved', 'members.full_name')
            ->orderBy('loans.id', 'desc')
            ->get();

    
        $data = [
            'members' => $members,
            'loans' => $loans,
            'pagetitle' => 'Loan Registration',
        ];
    
        return view('dashboard.LoanRepaymentForm')->with($data);
    }

     // Store repayment
     public function RegisterRepayment(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'loan_id' => 'required|exists:loans,id',
             'amount_paid' => 'required|numeric|min:0.01',
             'payment_date' => 'required|date',
             'payment_method' => 'required|string|max:50',
             'remarks' => 'nullable|string|max:255',
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }

         // Step 1: Get the original loan amount
            $loan = DB::table('loans')->where('id', $request->loan_id)->first();
            if (!$loan) {
                return redirect()->back()->with('error', 'Loan not found.');
            }

            $totalLoanAmount = $loan->amount_requested;

            // Step 2: Sum all previous repayments
            $totalRepaid = DB::table('loan_repayments')
            ->where('loan_id', $request->loan_id)
            ->sum('amount_paid');

             // Step 3: Add this repayment
            $newTotalRepaid = $totalRepaid + $request->amount_paid;

            // Step 4: Calculate balance
            $balance = $totalLoanAmount - $newTotalRepaid;
 
         DB::table('loan_repayments')->insert([
             'loan_id' => $request->loan_id,
             'amount_paid' => $request->amount_paid,
             'payment_date' => $request->payment_date,
             'payment_method' => $request->payment_method,
             'remarks' => $request->remarks,
             'balance_remaining' => $balance, // ✅ Ensure 'balance' column exists in your DB
             'created_at' => now(),
             'updated_at' => now(),
         ]);
         
         return back()->with('success', 'Repayment recorded successfully.');
         //return redirect()->route('repayments.create')->with('success', 'Repayment recorded successfully.');
     }


     public function loanStatement($loan_id)
        {
            $loan = DB::table('loans')->where('id', $loan_id)->first();

             // Fetch loan details
            $loan = DB::table('loans')
            ->join('members', 'loans.member_id', '=', 'members.id')
            ->select('loans.*', 'members.*')
            ->where('loans.id', $loan_id)
            ->first();

            $repayments = DB::table('loan_repayments')
                            ->where('loan_id', $loan_id)
                            ->orderBy('payment_date')
                            ->get();

            // Calculate total repaid
            $totalPaid = $repayments->sum('amount_paid');

             // Calculate balance
            $balance = $loan->amount_requested - $totalPaid;


            $originalAmount = $loan->amount_approved; // This should be total due after interest
            $runningBalance = $originalAmount;
            $runningRepayments = [];

            foreach ($repayments as $repayment) {
                $runningBalance -= $repayment->amount_paid;

                $runningRepayments[] = (object) [
                    'payment_date' => $repayment->payment_date,
                    'amount_paid' => $repayment->amount_paid,
                    'payment_method' => $repayment->payment_method,
                    'remarks' => $repayment->remarks,
                    'balance_after' => $runningBalance
                ];
            }

            $data=[
                'loan' => $loan,
                'repayments' => $runningRepayments,
                'originalAmount' => $originalAmount,
                'totalPaid' => $totalPaid,
                'balance' => $balance, 
            ];
    
            //return view('dashboard.reports.loanstatement')->with($data);    
         
            $pdf = PDF::loadView('dashboard.reports.loanstatement', $data);
            $pdf->setPaper('P', 'potrait');
                  return $pdf->stream();           
        }

    public function GenerateLoanStatement() 
    {
        $members = DB::table('members')->select('id', 'full_name')->get();

        $loans = DB::table('loans')
            ->join('members', 'loans.member_id', '=', 'members.id')
            ->select('loans.id', 'loans.loan_type', 'loans.amount_approved', 'members.full_name')
            ->orderBy('loans.id', 'desc')
            ->get();

    
        $data = [
            'members' => $members,
            'loans' => $loans,
            'pagetitle' => 'Loan Registration',
        ];
    
        return view('dashboard.LoanStatements')->with($data);
    }


}
