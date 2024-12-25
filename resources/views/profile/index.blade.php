@extends('layout.layout')
@section('content')
<BR>

<Center>
    <h4>Users</h4>
</Center>

@if ($profile->count() > 0)
<table class="table">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Photo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profile as $each_profile)
        <tr>
            <td>{{ $each_profile->id }}</td>
            <td>{{ $each_profile->name }}</td>

            <td>
                @if($each_profile->photo)
                <img src="{{ asset('storage/' . $each_profile->photo) }}" alt="Profile Picture" width="100">
                @else
                No photo
                @endif
            </td>


        </tr>
        @endforeach
    </tbody>
</table>

@else
<p>No orders are found.</p>


@endif
<!-- Render pagination links -->
{{ $profile->links() }}
<a href='/pizzaburg/profile/create'>Create an User</a>


@endsection