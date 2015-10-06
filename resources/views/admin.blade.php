@extends('master')

@section('content')
<div class="page-header">
  <h1>Management</h1>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Cell</th>
            <th>Unit</th>
            <th>Title</th>
            <th>Meal</th>
            <th>Seat</th>
            <th>Register Time</th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row )
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->cell }}</td>
            <td>{{ $row->unit }}</td>
            <td>{{ $row->title }}</td>
            <td>{{ $row->meal }}</td>
            <td>{{ $row->seat }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                @if ( $row->token != 'Not Paid' )
                    <a href="/admin/cancel/{{ $row->id }}" class="btn btn-xs btn-warning">Cancel Payment</a>
                @else
                    <a href="#" data-href="/admin/confirm/{{ $row->id }}" class="btn btn-xs btn-success confirm">Confirm Payment</a>
                @endif
                <a href="/seat/{{ $row->token }}" class="btn btn-xs btn-info">Select Seat</a>
                <a href="#" data-href="/admin/destroy/{{ $row->id }}" class="btn btn-xs btn-danger delete">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
$(function(){
    $('.delete').click(function(){
        var dest = $(this).data('href');
        if( confirm('Do you really want to delete this record?') ) {
            location.href = dest;
        }
    });
    $('.confirm').click(function(){
        var dest = $(this).data('href');
        if( confirm('This will send a mail to the selected person, do you wish to continue?') ) {
            location.href = dest;
        }
    });
});
</script>
@endsection
