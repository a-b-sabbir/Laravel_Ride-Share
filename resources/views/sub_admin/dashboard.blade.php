<h2>Sub Admin Dashboard</h2>

<p>Name: <b>{{ $getRecord->name }}</b></p>
<p>Email: <b>{{ $getRecord->email }}</b></p>
<p>Phone Number:  <b>{{ $getRecord->phone_number }}</b></p>
<p>Role:  <b>{{ $getRecord->role_id }}</b></p>

<a href="{{ url('logout') }}">Logout</a>