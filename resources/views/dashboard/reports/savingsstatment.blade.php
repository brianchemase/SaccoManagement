<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Contribution Statement</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        
    </style>
</head>
<body>
    <div style="text-align: center;" >
        <img src="{{public_path('logo/logo1.png')}}" alt="logo" width="70" height="70">
        <h1>Member Contribution Statement</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th align="centre">Member No: {{ $memberData->member_no ?? '' }}</th>
                <th align="centre">Member name : {{ $memberData->full_name ?? '' }}</th>
                <th align="centre">Member Contact: {{ $memberData->phone ?? '' }}</th>
                <th align="centre">Total Contribution: KES {{$TotalDeposits}}</th>
            </tr>
            <tr>
                <th colspan="2" align="centre">Total Savings Deposits: KES <span style="color: green;">{{ $TotalDeposits ?? '' }}</span></th>
                <th colspan="1">Total Withdrawals : KES <span style="color: red;">{{ $TotalWithdrawals ?? '' }}</span></th>
                <th align="centre">Savings Balance: KES {{$totalsavingsbal ?? ''}}</th>
            </tr>
        </thead>
    </table>
    <div style="text-align: center;">
        <h3>Member Contribution summary Statement</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statements as $year => $contributions)
                <tr>
                    <td>{{ $year }}</td>
                    @foreach($contributions as $contribution)
                        <td>{{ $contribution }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align: center;">
        <p><i><b>Report generated on Date from Sacco System<br> Contact : 07 for enquries</b></i></p>
        
    </div>

</body>
</html>
