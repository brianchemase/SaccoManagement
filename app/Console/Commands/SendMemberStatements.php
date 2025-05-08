<?php

namespace App\Console\Commands;
use App\Mail\MemberStatementMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class SendMemberStatements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:send-statements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send savings statements to all members via email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = DB::table('members')->whereNotNull('email')->get();

        foreach ($members as $member) {
            // Calculate totals
            $TotalDeposits = DB::table('savings')
                ->where('member_id', $member->id)
                ->where('transaction_type', 'deposit')
                ->sum('amount');

            $TotalWithdrawals = DB::table('savings')
                ->where('member_id', $member->id)
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');

            $Totalcontributions = DB::table('savings')
                ->where('member_id', $member->id)
                ->sum('amount');

            $totalsavingsbal = $TotalDeposits - $TotalWithdrawals;

            $distinctYears = DB::table('savings')
                ->select(DB::raw('YEAR(transaction_date) as year'))
                ->where('member_id', $member->id)
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');

            $statements = [];

            foreach ($distinctYears as $year) {
                $totalSum = DB::table('savings')
                    ->select(
                        DB::raw('SUM(amount) as total_amount'),
                        DB::raw('MONTH(transaction_date) as payment_month')
                    )
                    ->where('member_id', $member->id)
                    ->where('transaction_type', 'deposit')
                    ->whereYear('transaction_date', $year)
                    ->groupBy(DB::raw('MONTH(transaction_date)'))
                    ->pluck('total_amount', 'payment_month')
                    ->toArray();

                $statements[$year] = [];
                for ($month = 1; $month <= 12; $month++) {
                    $statements[$year][$month] = $totalSum[$month] ?? 0;
                }
            }

            $data = [
                'contributions' => "",
                'statements' => $statements,
                'memberData' => $member,
                'TotalDeposits' => $TotalDeposits,
                'TotalWithdrawals' => $TotalWithdrawals,
                'totalsavingsbal' => $totalsavingsbal,
                'Totalcontributions' => $Totalcontributions,
            ];

            // Generate the PDF
            $pdf = PDF::loadView('dashboard.reports.savingsstatment', $data);
            $pdf->setPaper('L', 'landscape');

            // Send email
            Mail::to($member->email)->send(new MemberStatementMail($pdf, $member));

            $this->info("Statement sent to: {$member->email}");
        }

        $this->info("All statements have been sent.");
    }
}
