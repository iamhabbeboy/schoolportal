@extends('layouts.main')

@section('content')
<div class="card-header">
        <div class="container">
            <h3>Dashboard</h3>
        </div>
    </div>
{{--  <div class="banner-bottom-w3l" id="about">  --}}
<div class="container" style="padding: 10px;font-size: 13px">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <form action="/user-profile" method="POST">
                                @csrf()
                                <div class="alert alert-info"><b>Note:</b> Complete your information</div>

                                <input type="hidden" name="studentID"
                                value="{{ array_get($student, 'id', '') }}">

                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control" required
                                value="{{ array_get($student, 'student_info.name', '') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" class="form-control" required
                                value="{{ array_get($student, 'student_info.email', '') }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Student No.</label>
                                <input type="text" class="form-control" disabled name="student_no"
                                value="{{ array_get($student, 'student_no', '') }}">

                                <input type="hidden" value="{{ array_get($student, 'student_no', '') }}"
                                name="student_no">
                            </div>
                            <div class="form-group">
                                <label for="">Programme</label>
                                <select name="programme" id="" class="form-control" required>
                                    @if( ! is_null( array_get($student, 'programme') ) )
                                        <option value="{{ array_get($student, 'programme')}}">
                                            {{ ucfirst(array_get($student, 'programme')) }}
                                        </option>
                                    @else
                                        <option value="">select</option>
                                        <option value="nursing">Nursing</option>
                                        <option value="midwifery">Midwifery</option>
                                        <option value="remedial">Remedial</option>
                                    @endif
                                </select>
                            </div>
                                <hr>

                            <div class="form-group">
                                <label for="">Date of Birth</label>
                                <input type="date" class="form-control" placeholder="dd/mm/yyyy"
                                name="dob" value="{{ array_get($student, 'dob', '')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" class="form-control" required name="phone_number"
                                value="{{ array_get($student, 'phone', '')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <select name="country" id="" class="form-control" required>
                                    <option value="">select</option>
                                    <option value="nigeria" {{(array_get($student, 'country', '') == 'nigeria' ? 'selected': '')}}>Nigeria</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">State</label>
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">select</option>
                                    @if( count( $states ) > 0 )
                                        @foreach ( $states as $state)
                                            <option value="{{ array_get($state, 'state_id') }}"
                                            {{(array_get($student, 'state', '') == array_get($state, 'state_id') ? 'selected': '')}}>
                                                {{ array_get($state, 'name') }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">LGA</label>
                                <select name="lga" id="local" class="form-control" required>
                                    <option value="{{ array_get($student, 'lga') }}">
                                        {{ array_get($student, 'lga') }}
                                    </option>
                                </select>
                            </div>
                                {{--  <input type="hidden" value="{{ array_get($student, 'lga') }}" name="lga">  --}}
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" id="" rows="2" class="form-control" required>{{ array_get($student, 'address', '')}}</textarea>
                            </div>
                                <p></p>
                                <br>
                                <button class="btn btn-success btn-lg">Submit</button>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="profile-holder" id="profile-ajax" style="overflow:hidden;">
                                @if( array_get($student, 'picture') )
                                    <img src="{{ array_get($student, 'picture')}}" width="200" height="199">
                                @else
                                    <img src="/images/avatar.png" width="200">
                                @endif
                            </div>
                            <div class="profile-pix">
                                <a href="#" id="profile" title="click to change picture"><img src="{{ asset('images/plus.png')}}" alt="" class="image"></a>
                            </div>
                            <form method="POST" action="/ajax-photo" enctype="multipart/form-data" id="ajaxData">
                                @csrf
                                <input type="file" name="photo" id="photo" style="visibility:hidden;height:1px;">
                            </form>
                            {{--  <div style="margin: auto;text-align:center">
                                <button class="btn btn-info btn-sm">Choose</button>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  </div>  --}}
@endsection

@section('javascript')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="/js/file-upload.js"></script>
    <script>
        @if($params == 'success')
            alert('Updated Successfully ');
            window.location = '/home'
        @endif

        $(document).ready(function() {
            $('#state').on('change', function(e) {
                let val     = $(this).val();
                let html    = '';
                let $that   = $('#local')
                //$that.attr('disabled', '')

                if(val != '' ) {
                    $('#local option:first').html('loading...')

                    $.ajax({
                        url: '/ajax-local',
                        method: 'post',
                        data: { 'state_id': val },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    }).done(function(resp) {
                        if( resp.status != 'success') {
                            return alert('Error Occured while getting result, please referesh the page')
                        } else {
                            let data = resp.data
                            $.each(data, function(k, v) {
                                let lga = v.local_name
                                html += `<option value="${lga}">${lga}</option>`
                            })
                            $that.html(html)
                            //$that.removeAttr('disabled')
                        }
                    }).fail(function(err) {
                        console.log(err)
                    })
                }
            })
        })
    </script>


@stop
