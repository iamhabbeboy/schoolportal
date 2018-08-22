@extends('layouts.data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            @if( array_get($_GET, 'rel') == 'more')
                                <div class="row" style="font-size: 13px;">
                                    <div class="col-md-3">
                                        <div>
                                            @if( array_get($student, 'picture') )
                                                <img src="/{{ array_get($student, 'picture')}}" alt="loading.." width="200" height="190" style="border: 1px solid #ccc;padding:2px;">
                                            @else
                                                <img src="/images/avatar.png" alt="loading.." width="200" height="190" style="border: 1px solid #ccc;padding:2px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <b>Full Name</b>
                                        <h6>{{ array_get($student, 'student_info.name') }}</h6>
                                        <b>Student No.</b>
                                        <h6>{{ array_get($student, 'student_no')}}</h6>
                                        <b>Date of Birth</b>
                                        <h6>{{ array_get($student, 'dob')}}</h6>
                                        <b>Phone No.</b>
                                        <h6>{{ array_get($student, 'phone')}}</h6>
                                        <b>Address</b>
                                        <h6>{{ array_get($student, 'address')}}</h6>
                                        <b>State</b>
                                        <h6>{{ ucfirst(array_get($student, 'state') ) }}</h6>
                                        <b>Country</b>
                                        <h6>{{ ucfirst(array_get($student, 'country') ) }}</h6>
                                        <b> Admission Status</b>
                                            <h6> {!! array_get($student, 'admission_status') == '1'
                                                ? '<span style="color: green">Student has been offered Admission</span>'
                                                : '<span style="color: #993300">N/A</span>' !!} </h6>


                                        <div style="padding: 5px;background: #ccc;"><b> O Level Result(s)</b> </div>

                                        @if( count(array_get($student, 'student_result')) > 0 )

                                            @foreach (array_get($student, 'student_result') as $olevel)

                                                <table class="table striped">
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Subject</td>
                                                        <td>Grade</td>
                                                    </tr>
                                                    {{--  {{dd(array_get($olevel, 'grade'))}}  --}}
                                                    @foreach( explode(',', array_get($olevel, 'grade')) as $key => $result )
                                                        <?php $exp = explode(':', $result) ?>
                                                        <tr>
                                                            <td> {{ $key+1}}</td>
                                                            <td> {{ $exp[0] }}</td>
                                                            <td> {{ $exp[1] }} </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endforeach

                                        @else
                                            <div class="alert alert-info">The O Level Result has not been uploaded </div>
                                        @endif
                                        <div class="alert alert-info">
                                            <form method="post" action="admission-status">
                                                @csrf
                                                <label for="">Offer admission </label>
                                                <select name="status" id="" style="padding: 5px;height: 40px;width: 200px;">
                                                    <option value="">select</option>
                                                    <option value="1" {{ array_get($student, 'admission_status') == '1' ? 'selected' : '' }}>Admitted</option>
                                                    <option value="0" {{ array_get($student, 'admission_status') == '0' ? 'selected' : '' }}>Not Admitted</option>
                                                </select>
                                                <button class="btn btn-primary">Submit </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @else
                                @if(count( $students) > 0)
                                    <div class="pull-right">
                                        <a href="/panel/studentinfo-csv" style="font-size: 12px;color: #FFF" class="btn btn-sm btn-dark">
                                            Export Student information </a>
                                    </div>
                                    <p></p>
                                    <table class="table" style="font-size: 12px;">
                                        <tr>
                                            <th>#</th>
                                            <th>Student No. </th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number </th>
                                            <th>State</th>
                                            <th>Admission Status</th>
                                            <th>Date</th>
                                            <th>View more </th>
                                        </tr>
                                        @foreach ($students as $key => $student)
                                            <tr>
                                                <td> {{ $key+1 }}</td>

                                                <td> {{ array_get($student, 'student_no', '') }}</td>
                                                <td> {{ ucfirst(array_get($student, 'student_info.name', '')) }}</td>
                                                <td> {{ array_get($student, 'student_info.email', '') }}</td>
                                                <td> {{ array_get($student, 'phone', '') }}</td>
                                                <td> {{ findById(array_get($student, 'state', '')) }}</td>
                                                <td> {!! (array_get($student, 'admission_status' ) == '1' )
                                                        ? '<span style="color: green">Admitted</span>'
                                                        : '<span style="color: #993300">N/A</span>'
                                                    !!} </td>
                                                <td> {{ array_get($student, 'student_info.created_at', '') }}</td>
                                                <td> <a href="?rel=more&student_id={{array_get($student, 'student_info.id') }}">view more </a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        /*$(function() {
            const elem = $('#profile')
            elem.click(function() {
                const photo = $('#photo').click();
            })
        })*/

        @if( array_get($_GET, 'rel') == 'status')
            alert('Admission status changed Successfully ');
            window.location = '/panel/students'
        @endif
    </script>
@stop
