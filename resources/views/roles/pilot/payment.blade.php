@extends('layout.pilot.layout')

@section('content')

<div class="container">
    <h2>Make a Payment</h2>

    <form action="{{ route('pilot.payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="pilot_assignment_id" value="{{ auth()->user()->pilot->assignments->id }}">

        <div class="mb-3">
            <label class="form-label">Amount to Pay</label>
            <input type="number" class="form-control" name="paid_amount" value="2500" readonly required>
        </div>

        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>


@endsection