@extends('layouts.main')

<script>
    function payWithPaystack(){
      var handler = PaystackPop.setup({
        key: 'pk_test_9a43898ab251ad980ab725f6b0078861efbe017c',
        email: 'info@kbssonm.com',
        amount: 5500*100,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: "Kebbi State School of Nursing",
                  variable_name: "mobile_number",
                  value: "+2348012345678"
              }
           ]
        },
        callback: function(response){
            console.log(response)
            if ( response.status == 'success') {

                $.ajax({
                    url: '/payment',
                    method: 'post',
                    data: response,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        if( resp.status == 'success') {
                            window.location = '?rel=1'
                        } else {
                            window.location = '?rel=0'
                        }
                    },
                    error: function (er) {
                        console.log(er)
                    }
                })
            } else {
                window.location = '?rel=0'
            }
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }
  </script>
@section('content')
<br>
<div class="card-header">
    <div class="container">
        <h3>Obtain Application Form</h3>
    </div>
</div>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <br><br>
                            <div class="card-body">

                                @if( $payment_callback == '1')
                                    <div class="alert alert-success"><h4>Payment Sucessful</h4>
                                        <p> click below to complete your information</p>
                                        <p>
                                            <a href="/dashboard">click here to continue</a>
                                        </p>
                                    </div>
                                @elseif( $payment_callback == '0')
                                    <div class="alert alert-danger"><b>Payment Unsucessful</b>
                                        <p>
                                            click below to try again
                                        </p>
                                        <p>
                                            <a href="/form">click here to try again</a>
                                        </p>
                                    </div>
                                @else

                                    <div class="alert-info alert">
                                        You are about to obtain the admission form of Kebbi State School of Nursing &amp; Midwifery
                                    </div>
                                    <form action="/pay" method="post">
                                        <script src="https://js.paystack.co/v1/inline.js"></script>
                                        <table class="table table-striped" style="color: #000;font-size: 13px">
                                            <tr>
                                                <th>Payment For</th>
                                                <th> Amount </th>
                                                <th>Total </th>
                                            </tr>
                                            <tr>
                                                <td>Admission Form</td>
                                                <td> &#8358; 5, 500.00 </td>
                                                <td> &#8358; 5, 500.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td>

                                                    <button id="payment" type="button" onclick="payWithPaystack()" class="btn-success btn btn-sm">Pay with ATM Card</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>

                                    {{-- <form >
                                        <button type="button" onclick="payWithPaystack()"> Pay </button>
                                      </form>
 --}}

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br><br><br>

    @section('javascript')
        {{--  <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
        <script src="/js/portal.js"></script>
        <script>
            $(function(){
                $('#payment').on('click', function(e) {
                    return Portal.make_payment(3000);
                })
            })


        </script>  --}}


    @stop
@stop