@extends('layout.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <h4>
                        <center>Vehicle Registration Paper Form</center>
                    </h4>
                    <div class="mb-3">
                        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf


                            <!-- Registration Number -->
                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number', $details['registration_number'] ?? '') }}">
                            </div>
                            <!-- Registration Date -->
                            <div class="mb-3">
                                <label for="registration_date" class="form-label">Registration Date</label>
                                <input type="text" class="form-control" id="registration_date" name="registration_date" value="{{ old('registration_date', $details['registration_date'] ?? '') }}">
                            </div>

                            <!-- Tax Token Number -->
                            <div class="mb-3">
                                <label for="tax_token_number" class="form-label">Tax Token Number</label>
                                <input type="text" class="form-control" id="tax_token_number" name="tax_token_number" value="{{ old('tax_token_number', $details['tax_token_number'] ?? '') }}">
                            </div>

                            <!-- Transaction No. -->
                            <div class="mb-3">
                                <label for="transaction_no" class="form-label">Transaction No.</label>
                                <input type="text" class="form-control" id="transaction_no" name="transaction_no" value="{{ old('transaction_no', $details['transaction_no'] ?? '') }}">
                            </div>

                            <!-- eTracking No. -->
                            <div class="form-group">
                                <label for="date">eTracking No</label>
                                <input type="text" id="eTracking_no" name="eTracking_no" class="form-control" value="{{ old('eTracking_no', $details['eTracking_no'] ?? '') }}" required>
                            </div>

                            <!-- Issuing Bank Name -->
                            <div class="form-group">
                                <label for="date">Issuing Bank Name</label>
                                <input type="text" id="issuing_bank_name" name="issuing_bank_name" class="form-control" value="{{ old('issuing_bank_name', $details['issuing_bank_name'] ?? '') }}" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection