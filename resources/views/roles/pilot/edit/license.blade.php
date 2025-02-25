@extends("layout.layout")

@section("content")
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
                        <center>Edit Pilot License Information</center>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pilots.update.license', $pilot) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- License Photo -->
                        <div class="mb-3">
                            <label for="nid_image" class="form-label fw-bold">License Photo</label>

                            <div class="mb-2">
                                <img id="license_preview"
                                    src="{{ $pilot->license->license_photo ? asset('storage/' . $pilot->license->license_photo) : asset('default-license.png') }}"
                                    alt="License Image"
                                    class="img-thumbnail rounded-circle"
                                    width="100" height="100"
                                    style="object-fit: cover;">
                            </div>

                            <input type="file" class="form-control" name="license_photo" id="license_photo" accept="image/*">
                        </div>

                        <!-- License Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label fw-bold required">License Type</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="Professional" {{ old('type', $pilot->license->type) == 'Professional' ? 'selected' : '' }}>Professional</option>
                                <option value="Non-Professional" {{ old('type', $pilot->license->type) == 'Non-Professional' ? 'selected' : '' }}>Non-Professional</option>
                            </select>
                            @if ($errors->has('type'))
                            <div class="text-danger">
                                <small>{{ $errors->first('type') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold required">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $pilot->license->name) }}" required>
                            @if ($errors->has('name'))
                            <div class="text-danger">
                                <small>{{ $errors->first('name') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold required">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $pilot->license->address) }}" required>
                            @if ($errors->has('address'))
                            <div class="text-danger">
                                <small>{{ $errors->first('address') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Birth Date -->
                        <div class="mb-3">
                            <label for="birth_date" class="form-label fw-bold required">Birth Date</label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date', $pilot->license->birth_date) }}" required>
                            @if ($errors->has('birth_date'))
                            <div class="text-danger">
                                <small>{{ $errors->first('birth_date') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Blood Group -->
                        <div class="mb-3">
                            <label for="blood_group" class="form-label fw-bold required">Blood Group</label>
                            <select class="form-select" name="blood_group" id="blood_group" required>
                                <option value="A+" {{ old('blood_group', $pilot->license->blood_group) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group', $pilot->license->blood_group) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group', $pilot->license->blood_group) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="AB+" {{ old('blood_group', $pilot->license->blood_group) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group', $pilot->license->blood_group) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="B-" {{ old('blood_group', $pilot->license->blood_group) == 'B-' ? 'selected' : '' }}>B-</option>
                            </select>
                            @if($errors->has('blood_group'))
                            <div class="text-danger">
                                <small>{{ $errors->first('blood_group') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Father/Husband Name -->
                        <div class="mb-3">
                            <label for="father_or_husband_name" class="form-label fw-bold required">Father/Husband Name</label>
                            <input type="text" class="form-control" name="father_or_husband_name" id="father_or_husband_name" value="{{ old('father_or_husband_name', $pilot->license->father_or_husband_name) }}" required>
                            @if ($errors->has('father_or_husband_name'))
                            <div class="text-danger">
                                <small>{{ $errors->first('father_or_husband_name') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- License Number -->
                        <div class="mb-3">
                            <label for="license_number" class="form-label fw-bold required">License Number</label>
                            <input type="text" class="form-control" name="license_number" id="license_number" value="{{ old('license_number', $pilot->license->license_number) }}" required>
                            @if ($errors->has('license_number'))
                            <div class="text-danger">
                                <small>{{ $errors->first('license_number') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Issue Date -->
                        <div class="mb-3">
                            <label for="issue_date" class="form-label fw-bold required">Issue Date</label>
                            <input type="date" class="form-control" name="issue_date" id="issue_date" value="{{ old('issue_date', $pilot->license->issue_date) }}" required>
                            @if ($errors->has('issue_date'))
                            <div class="text-danger">
                                <small>{{ $errors->first('issue_date') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Expiry Date -->
                        <div class="mb-3">
                            <label for="expiry_date" class="form-label fw-bold required">Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $pilot->license->expiry_date) }}" required>
                            @if ($errors->has('expiry_date'))
                            <div class="text-danger">
                                <small>{{ $errors->first('expiry_date') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Ref No (Optional) -->
                        <div class="mb-3">
                            <label for="ref_no" class="form-label fw-bold">Reference Number</label>
                            <input type="number" class="form-control" name="ref_no" id="ref_no" value="{{ old('ref_no', $pilot->license->ref_no) }}">
                            @if ($errors->has('ref_no'))
                            <div class="text-danger">
                                <small>{{ $errors->first('ref_no') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Issuing Authority -->
                        <div class="mb-3">
                            <label for="issuing_authority" class="form-label fw-bold required">Issuing Authority</label>
                            <input type="text" class="form-control" name="issuing_authority" id="issuing_authority" value="{{ old('issuing_authority', $pilot->license->issuing_authority) }}" required>
                            @if ($errors->has('issuing_authority'))
                            <div class="text-danger">
                                <small>{{ $errors->first('issuing_authority') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update License Information</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profile_photo').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profile_preview').src = reader.result;
        };
        if (event.target.files.length) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

@endsection