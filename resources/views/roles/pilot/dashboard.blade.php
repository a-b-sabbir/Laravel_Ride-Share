@extends('layout.pilot.layout')

@section('content')
<h1>Welcome, {{ $getRecord->name }}!</h1>
<p class="lead">Here are some key metrics and controls for managing the platform:</p>

<div class="row">
    <div class="card p-3 mb-3">
        <h5>Account Status</h5>
        <p><strong>Login Days Left:</strong> {{ auth()->user()->pilot->assignments->login_days }}</p>
        <p><strong>Payment Due Date:</strong> {{ auth()->user()->pilot->payment_due_date }}</p>
    </div>

    <div class="text-center">
        <a href="{{ route('pilot.payment') }}" class="btn btn-success">Make a Payment</a>
    </div>
</div>
@endsection