<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SavingsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $data = [];
        $duplicates = [];

        foreach ($rows as $row) {
            $exists = DB::table('savings')->where([
                ['member_id', '=', $row['member_id']],
                ['amount', '=', $row['amount']],
                ['transaction_type', '=', $row['transaction_type']],
                ['transaction_date', '=', $row['transaction_date']],
            ])->exists();

            if ($exists) {
                $duplicates[] = $row;
            } else {
                $data[] = [
                    'member_id'         => $row['member_id'],
                    'amount'            => $row['amount'],
                    'transaction_type'  => $row['transaction_type'],
                    'transaction_date'  => $row['transaction_date'],
                    'remarks'           => $row['remarks'],
                ];
            }
        }

        if (!empty($duplicates)) {
            throw new \Exception("Duplicate records found. Upload aborted.");
        }

        if (!empty($data)) {
            DB::table('savings')->insert($data);
        }
    }
}
