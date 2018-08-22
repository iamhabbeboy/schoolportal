<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tuition Fee Payment Slip</title>
    {{--  <link rel="stylesheet" href="" media="screen">  --}}
    <style>
        .container {
            width: 800px;
            /*border: 1px solid #ccc;*/
            padding: 5px;
            margin: 20px auto;
        }
        body {
            font-family: arial, 'Courier New', Courier, monospace;
            font-size: 13px;
        }

        .table {
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #999;
        }

        table > tr {
            border-bottom: 1px solid #ccc !important;
            padding: 5px;
        }

        .background {
            background: #FFF;
            height: 50px;
        }

        .white {
            height: 50px;
        }

        h3 {
            text-transform: uppercase;
        }

        .image-logo {
            width: 50px;
            height: 50px;
            position: relative;
            left: 80px;
        }

        .align-left {
            text-align: left;
        }

        .student-info {
            border-bottom: 1px dashed #ccc;
            padding: 10px;
        }

        .border {
            background: #EEE;
            padding: 5px;
        }

        a{
            color: #000;
            text-transform: uppercase;
            text-decoration: none;
        }

        .h {
            height: 50px;
            border-bottom: 1px solid #ccc
        }

    </style>
</head>
<body>
    <div style="width: 800px;margin: 5px auto;">
        <p>
            <a href="/dashboard">&leftarrow; Back </a>&nbsp; | &nbsp; <a href="#" onclick="window.print()"><b>[ print ]</b></a>
        </p>
    </div>
    <div class="container">
        <table align="center" class="table" cellpadding="5"
        cellspacing="0" style="background: #FFF;">
            <tr class="background">
                <td colspan="3">
                    <h1><img src="/images/bg5.jpg" class="image-logo" align="left"> Kebbi State School of Nursing &amp; Midwifery</h1>
                    <h5>Birnin Kebbi, Kebbi State, NIGERIA</h5>
                    <p></p>
                </td>
            </tr>
            <tr class="white border">
                <td>
                    http://kbssonm.com
                </td>
                <td>
                    Email: info@kbssonm.com
                </td>
                <td>
                    Tel: +23478087322191
                </td>
            </tr>
            <tr class="background align-left">
                <td>
                    <div class="student-info">Name: {{ ucfirst(array_get($student, 'student_info.name')) }}</div>
                    <div class="student-info">Reg No.: {{ array_get($student, 'student_no')}} </div>
                    <div class="student-info">Programme: <b>{{ ucfirst(array_get($student, 'programme')) }}</b> </div>
                </td>
                <td>&nbsp;</td>
                <td>
                    <div class="student-info">
                        Date: {{ date('d')}} {{ date('M')}}, {{ date('Y')}}
                    </div>
                </td>
            </tr>
            <tr class="background border">
                <td colspan="3">
                    <h3> Print Payment History </h3>
                </td>
            </tr>
            <tr class="background" style="text-align: justify">
                <td colspan="3">
                    <table style="width: 100%;background: #ccc" border="0" cellpadding="5" cellspacing="1">
                        {{-- {{ dd(array_get($student, 'payment_info'))}} --}}
                        @if( count(array_get($student, 'payment_info')) > 0 )
                            <tr style="height: 50px">
                                <th>Payment Mode </th>
                                <th>Reference No.</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            @php($total = 0)
                            @foreach( array_get($student, 'payment_info') as $key => $payment)
                                @php($total += (int)array_get($payment, 'amount'))
                                <tr class="h"
                                    @if(($key+1)%2) == 0
                                        style="background: #FFF"
                                    @endif>
                                    <td> {{ array_get($payment, 'payment_type') }} </td>
                                    <td>{{ array_get($payment, 'ref_num') }}</td>
                                    <td> &#8358;
                                        {{ array_get($payment, 'amount') }} </td>
                                    <td> {{ array_get($payment, 'created_at') }} </td>
                                </tr>
                            @endforeach
                            <tr class="h" style="background-color: #ddd">

                                <td colspan="2">&nbsp;  </td>
                                <td>
                                        <h4>Total</h4>
                                </td>
                                <td>
                                    <h4>&#8358;
                                    {{ $total }}
                                    </h4>
                                </td>
                            </tr>

                        @else
                            <tr>
                                <td colspan="3"> No Payment Record Available </td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: justify">
                    {{-- <p>
                        Yours faithfully,
                    </p>
                    <h5>Adeyemi Ademola</h5>
                    <b>For: Registrar</b> --}}
                </td>
                <td colspan="2">&nbsp;</td>
            </tr>

        </table>
    </div>
</body>
</html>