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
                        <center>Edit Pilot Information</center>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pilots.update.basic', $pilot) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Profile Photo -->
                        <div class="mb-3">
                            <label for="profile_photo" class="form-label fw-bold">Profile Photo</label>

                            <div class="mb-2">
                                <img id="profile_preview"
                                    src="{{ $pilot->user->profile_photo ? asset('storage/' . $pilot->user->profile_photo) : asset('default-profile.png') }}"
                                    alt="Profile Photo"
                                    class="img-thumbnail rounded-circle"
                                    width="100" height="100"
                                    style="object-fit: cover;">
                            </div>

                            <!-- Hidden Input to Keep Old Image -->
                            <input type="hidden" name="old_profile_photo" value="{{ $pilot->user->profile_photo }}">

                            <input type="file" class="form-control" name="profile_photo" id="profile_photo" accept="image/*">
                            @if ($errors->has('profile_photo'))
                            <div class="text-danger">
                                <small>{{ $errors->first('profile_photo') }}</small>
                            </div>
                            @endif
                        </div>


                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold required">Full Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $pilot->user->name }}" required>
                            @if ($errors->has('name'))
                            <div class="text-danger">
                                <small>{{ $errors->first('name') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold required">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $pilot->user->email }}" required>
                            @if ($errors->has('email'))
                            <div class="text-danger">
                                <small>{{ $errors->first('email') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phone_number" class="form-label fw-bold required">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $pilot->user->phone_number }}" required>
                            @if ($errors->has('phone_number'))
                            <div class="text-danger">
                                <small>{{ $errors->first('phone_number') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- NID -->
                        <div class="mb-3">
                            <label for="nid" class="form-label fw-bold required">National ID (NID)</label>
                            <input type="text" class="form-control" name="nid" id="nid" value="{{ $pilot->nid }}" required>
                            @if ($errors->has('nid'))
                            <div class="text-danger">
                                <small>{{ $errors->first('nid') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- NID Photo -->
                        <div class="mb-3">
                            <label for="nid_image" class="form-label fw-bold">NID Image</label>

                            <div class="mb-2">
                                <img id="nid_preview"
                                    src="{{ $pilot->nid_image ? asset('storage/' . $pilot->nid_image) : asset('default-nid.png') }}"
                                    alt="NID Image"
                                    class="img-thumbnail rounded-circle"
                                    width="100" height="100"
                                    style="object-fit: cover;">
                            </div>

                            <input type="file" class="form-control" name="nid_image" id="nid_image" accept="image/*">
                            @if ($errors->has('nid_image'))
                            <div class="text-danger">
                                <small>{{ $errors->first('nid_image') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Emergency Contact Details -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="emergency_contact_name" class="form-label fw-bold">Emergency Contact Name</label>
                                <input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" value="{{ $pilot->emergency_contact_name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="emergency_contact_number" class="form-label fw-bold">Emergency Contact Number</label>
                                <input type="text" class="form-control" name="emergency_contact_number" id="emergency_contact_number" value="{{ $pilot->emergency_contact_number }}">
                            </div>
                        </div>

                        <!-- Relation with Emergency Contact -->
                        <div class="mb-3">
                            <label for="relation_with_emergency_contact" class="form-label fw-bold">Relation with Emergency Contact</label>
                            <input type="text" class="form-control" name="relation_with_emergency_contact" id="relation_with_emergency_contact" placeholder="e.g., Father, Friend" value="{{ $pilot->relation_with_emergency_contact }}" required>
                            @if ($errors->has('relation_with_emergency_contact'))
                            <div class="text-danger">
                                <small>{{ $errors->first('relation_with_emergency_contact') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Preferred Shift -->
                        <div class="mb-3">
                            <label for="preferred_shift" class="form-label fw-bold">Preferred Shift</label>
                            <select class="form-select" name="preferred_shift" id="preferred_shift">
                                <option value="day" {{ $pilot->preferred_shift == 'day' ? 'selected' : '' }}>Day</option>
                                <option value="night" {{ $pilot->preferred_shift == 'night' ? 'selected' : '' }}>Night</option>
                                <option value="flexible" {{ $pilot->preferred_shift == 'flexible' ? 'selected' : '' }}>Flexible</option>
                            </select>
                            @if ($errors->has('preferred_shift'))
                            <div class="text-danger">
                                <small>{{ $errors->first('preferred_shift') }}</small>
                            </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Update</button>
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

    document.getElementById('nid_image').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            document.getElementById('nid_preview').src = reader.result;
        };
        if (event.target.files.length) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

@endsection