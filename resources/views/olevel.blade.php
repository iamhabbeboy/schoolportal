@extends('layouts.data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> O Level </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="{{ route('add_olevel') }}" method="POST">
                                        @csrf
                                        <label for="">Subject </label>
                                        <input type="text" class="form-control" name="subject" value="{{$title}}" required spellcheck="false" autocomplete="off">
                                        <input type="hidden" value="{{ $id }}" name="subject_id">
                                        <p></p>
                                        <button class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <div style="height: 300px;overflow: auto;">
                                    @if( count( $olevel ) > 0)
                                        <table class="table striped" style="font-size: 13px">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Date Added</th>
                                                <th> Option </th>
                                            </tr>
                                            @foreach( $olevel as $key => $result)
                                                <tr>
                                                    <td>{{ $key+1}}</td>
                                                    <td>{{ $result->name}}</td>
                                                    <td> {{ $result->created_at}}</td>
                                                    <td>
                                                        <a href="?rel=edit&subject_title={{ $result->name }}&subject_id={{$result->id}}">
                                                            Edit
                                                        </a> &nbsp;
                                                        <a href="?rel=delete&subject_id={{ $result->id }}">
                                                            Delete
                                                        </a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <div class="alert-info alert">
                                            <b>No subject added yet</b>
                                            <p>fill in subject accepted by the left corner </p>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
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
        @if(array_get($_GET, 'rel') == '1')
            alert('Subject Added Successfully ')
            window.location = '/panel/result'
        @elseif(array_get($_GET, 'rel') == '0')
            alert('Subject Already Exist')
            window.location = '/panel/result'
        @endif

    </script>
@stop
