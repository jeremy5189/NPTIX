@extends('master')

@section('content')
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
                    <button type="button" class="btn btn-xs btn-warning">Cancel Payment</button>
                @else
                    <button type="button" class="btn btn-xs btn-success">Confirm Payment</button>
                @endif
                <button type="button" class="btn btn-xs btn-info">Select Seat</button>
                <button type="button" class="btn btn-xs btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
