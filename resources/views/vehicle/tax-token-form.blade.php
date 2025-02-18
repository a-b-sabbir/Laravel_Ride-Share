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
                        <center>Tax Token Form</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('vehicle.uploadTaxToken') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <!-- Vehicle ID -->
                            <input type="hidden" class="form-control" name="vehicle_id" id="vehicle_id" value="{{ $vehicleID }}">
                            @if ($errors->has('vehicle_id'))
                            <div class="text-danger">
                                <small>{{ $errors->first('vehicle_id') }}</small>
                            </div>
                            @endif

                            <!-- Tax Token Photo -->
                            <div class="mb-3">
                                <label for="tax_token_photo" class="form-label fw-bold required">Tax Token Photo</label>
                                <input type="file" class="form-control" name="tax_token_photo" id="tax_token_photo">
                                @if ($errors->has('tax_token_photo'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('tax_token_photo') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Print Date -->
                            <div class="mb-3">
                                <label for="print_date" class="form-label fw-bold required">Print Date</label>
                                <input type="date" class="form-control" id="print_date" name="print_date">
                                @if ($errors->has('print_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('print_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Registration Number -->
                            <div class="mb-3">
                                <label for="registration_number" class="form-label fw-bold required">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number">
                                @if ($errors->has('registration_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('registration_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Registration Date -->
                            <div class="mb-3">
                                <label for="registration_date" class="form-label fw-bold required">Registration Date</label>
                                <input type="date" class="form-control" id="registration_date" name="registration_date">
                                @if ($errors->has('registration_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('registration_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Tax Token Number -->
                            <div class="mb-3">
                                <label for="tax_token_number" class="form-label fw-bold required">Tax Token Number</label>
                                <input type="text" class="form-control" id="tax_token_number" name="tax_token_number">
                                @if ($errors->has('tax_token_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('tax_token_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Transaction No. -->
                            <div class="mb-3">
                                <label for="transaction_number" class="form-label fw-bold required">Transaction No.</label>
                                <input type="text" class="form-control" id="transaction_number" name="transaction_number">
                                @if ($errors->has('transaction_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('transaction_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- eTracking No. -->
                            <div class="mb-3">
                                <label for="eTracking_no" class="form-label fw-bold required">eTracking No</label>
                                <input type="text" id="eTracking_no" name="eTracking_no" class="form-control">
                                @if ($errors->has('eTracking_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('eTracking_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issuing Bank Name -->
                            <div class="mb-3">
                                <label for="issuing_bank_name" class="form-label fw-bold required">Issuing Bank Name</label>
                                <input type="text" id="issuing_bank_name" name="issuing_bank_name" class="form-control">
                                @if ($errors->has('issuing_bank_name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('issuing_bank_name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issuing Branch -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Issuing Branch</label>
                                <input type="text" id="issuing_branch" name="issuing_branch" class="form-control">
                                @if ($errors->has('issuing_branch'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('issuing_branch') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issuing Teller Name -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Issuing Teller Name</label>
                                <input type="text" id="issuing_teller_name" name="issuing_teller_name" class="form-control">
                                @if ($errors->has('issuing_teller_name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('issuing_teller_name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Chassis No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Chassis No</label>
                                <input type="text" id="chassis_number" name="chassis_number" class="form-control">
                                @if ($errors->has('chassis_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('chassis_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Engine No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Engine No</label>
                                <input type="text" id="engine_number" name="engine_number" class="form-control">
                                @if ($errors->has('engine_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('engine_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Seats -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Seats</label>
                                <input type="text" id="seats" name="seats" class="form-control">
                                @if ($errors->has('seats'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('seats') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Laden Weight -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Laden Weight</label>
                                <input type="text" id="laden_weight" name="laden_weight" class="form-control">
                                @if ($errors->has('laden_weight'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('laden_weight') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Owner Name -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Owner Name</label>
                                <input type="text" id="owner_name" name="owner_name" class="form-control">
                                @if ($errors->has('owner_name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('owner_name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Father or Husband Name -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Father or Husband Name</label>
                                <input type="text" id="father_or_husband_name" name="father_or_husband_name" class="form-control">
                                @if ($errors->has('father_or_husband_name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('father_or_husband_name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Previous Expiry Date -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Previous Expiry Date</label>
                                <input type="date" id="previous_expiry_date" name="previous_expiry_date" class="form-control">
                                @if ($errors->has('previous_expiry_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('previous_expiry_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issue Date -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Issue Date</label>
                                <input type="date" id="issue_date" name="issue_date" class="form-control">
                                @if ($errors->has('issue_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('issue_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Tax Period Start -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Tax Period Start</label>
                                <input type="date" id="tax_period_start" name="tax_period_start" class="form-control">
                                @if ($errors->has('tax_period_start'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('tax_period_start') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Tax Period End -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Tax Period End</label>
                                <input type="date" id="tax_period_end" name="tax_period_end" class="form-control">
                                @if ($errors->has('tax_period_end'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('tax_period_end') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Principal Amount -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Principal Amount</label>
                                <input type="text" id="principal_amount" name="principal_amount" class="form-control">
                                @if ($errors->has('principal_amount'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('principal_amount') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Fine -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Fine</label>
                                <input type="text" id="fine" name="fine" class="form-control">
                                @if ($errors->has('fine'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('fine') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Total Amount -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Total Amount</label>
                                <input type="text" id="total_amount" name="total_amount" class="form-control">
                                @if ($errors->has('total_amount'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('total_amount') }}</small>
                                </div>
                                @endif
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