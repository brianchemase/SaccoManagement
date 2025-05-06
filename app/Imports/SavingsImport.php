<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SavingsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'member_id'         => $row['member_id'],
                'amount'            => $row['amount'],
                'transaction_type'  => $row['transaction_type'],
                'transaction_date'  => $row['transaction_date'],
                'remarks'           => $row['remarks'],
            ];
        }

        DB::table('savings')->insert($data);
    }
}
