<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{public_path('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{public_path('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<style>
.table-condensed{
  font-size: 11px;
}
</style>

    <title>Loan Statements</title>
  </head>
  <body>
  <div style="text-align: center;">
    <img src="{{public_path('logo/logo1.png')}}" alt="logo" width="50" height="60">
</div>
  
    <h2 class="mb-2 text-center" >Client Loan Statements</h2>
    <P>Loan statement belonging to: <b>{{ $loan->full_name }}</b> ID Number <b> {{ $loan->id_number }} </b> Loan ID {{ $loan->id }} and phone:<b> {{ $loan->phone }} </b></P>

    <table class="table table-striped table-sm" style="width:100%, font-size: 8px;">
       
        <tbody>
            <tr>
                <th scope="row">Loan ID</th>
                <td>{{ $loan->id }}</td>
                <th scope="row">Client ID Number</th>
                <td>{{ $loan->id_number }}</td>
            </tr>
            <tr>
                <th scope="row">Client names</th>
                <td>{{ $loan->full_name }}</td>
                <th scope="row">Disbursement Date:</td>
                <td> {{ \Carbon\Carbon::parse($loan->disbursement_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th scope="row">Loan Amount</th>
                <td>{{ number_format($loan->amount_requested) }}</td>
                <th scope="row">Application Date:</th>
                <td> {{ \Carbon\Carbon::parse($loan->application_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th scope="row">Loan Duration:</td>
                <td> {{ $loan->term_months }} months</td>
                
                <th scope="row">Disbursement Date:</td>
                <td> {{ \Carbon\Carbon::parse($loan->disbursement_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th scope="row">Repayment Amount</th>
                <td>{{ number_format($loan->amount_approved) }}</td>
                <th scope="row">Monthly Installments:</td>
                <td>Installments</td>
            </tr>
            <tr>
                <th scope="row">Loan Application Fee</th>
                <td>Fee </td>
                <th scope="row">Loan End Date:</td>
                <td> End date</td>
            </tr>
        </tbody>
        </table>

                  <div class="table-condensed table-sm">
                    <table id="dataTable" class="table table-striped table-sm"  style="width:100%, font-size: 8px;">
                          <thead>
                              <tr>
                                <th>Date</th>
                                <th>Amount Paid (KES)</th>
                                <th>Payment Method</th>
                                <th>Remarks</th>
                                <th>Balance After (KES)</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                            @forelse ($repayments as $repayment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($repayment->payment_date)->format('d M Y') }}</td>
                                    <td>{{ number_format($repayment->amount_paid, 2) }}</td>
                                    <td>{{ $repayment->payment_method }}</td>
                                    <td>{{ $repayment->remarks }}</td>
                                    <td class="{{ $repayment->balance_after > 0 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($repayment->balance_after, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No repayments recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                          <tfoot>
                              <tr> 
                              <th>Date</th>
                                <th>Amount Paid (KES)</th>
                                <th>Payment Method</th>
                                <th>Remarks</th>
                                <th>Balance After (KES)</th>
                              </tr>
                          </tfoot>
                      </table>
                  </div>
                  <p class="mb-2 text-center"><I>Report generated by <b>{{ Session::get('username') }} Username </b> as of {{ now()->format('F j, Y') }}   <br>Report generated from Sacco System </I></p>
              
          
          

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>