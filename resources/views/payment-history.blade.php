@extends('layouts.main')


@section('content')
<br>
<div class="card-header">
    <div class="container">
        <h3>Payment History</h3>
    </div>
</div>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <br><br>
                            <div class="card-body">

                                    <div class="alert-info alert">
                                        Payment Tracker
                                    </div>

                                    @if( count($history) > 0 )
                                        <table class="table table-striped" style="color: #000;font-size: 13px">
                                            <tr>
                                                <th>#</th>
                                                <th> Ref Num </th>
                                                <th> status </th>
                                                <th>Currency</th>
                                                <th> Amount </th>
                                                <th>Total </th>
                                                <th>Date </th>
                                            </tr>
                                            @foreach($history as $key => $single)
                                                <tr>
                                                    <td>{{ $key+1}} </td>
                                                    <td> {{ array_get($single, 'ref_num') }} </td>
                                                    <td>
                                                        @if( array_get($single, 'status') == 'success')
                                                            <span style="color: green">{{ array_get($single, 'status') }}</span>
                                                        @else
                                                            <span style="color: #993300">{{ array_get($single, 'status') }}</span>
                                                        @endif
                                                    </td>
                                                    <td> {{ array_get($single, 'currency')}} </td>
                                                    <td> &#8358; {{ array_get($single, 'amount')}} </td>
                                                    <td> <b>&#8358; {{ array_get($single, 'amount')}}</b> </td>
                                                    <td> {{ array_get($single, 'created_at') }} </td>
                                                </tr>

                                            @endforeach
                                        </table>
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br><br><br>

    @section('javascript')
        <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
        <script src="/js/portal.js"></script>
        <script>
            $(function(){
                $('#payment').on('click', function(e) {
                    return Portal.make_payment(3000);
                })
            })


        </script>


    @stop
@stop