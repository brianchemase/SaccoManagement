<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SavingsPreferencesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('preferred_savings')
            ->join('members', 'preferred_savings.member_id', '=', 'members.id')
            ->select(
                'members.member_no as Member No',
                'members.full_name as Member Name',
                'members.email as Email',
                'preferred_savings.preferred_amount as Preferred Amount',
                'preferred_savings.effective_from as Effective From',
                'preferred_savings.created_at as Registered At'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Member No',
            'Member Name',
            'Email',
            'Preferred Amount',
            'Effective From',
            'Registered At',
        ];
    }
}
