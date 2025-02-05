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
                        <center>Vehicle Info Form</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('vehicle.upload') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <!-- Type -->
                            <div class="mb-3">
                                <label for="type" class="form-label fw-bold required">Type</label>
                                <select class="form-select" name="type" id="type">
                                    <option value="Car">Car</option>
                                    <option value="Bike">Bike</option>
                                </select>
                                @if($errors->has('type'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('type') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Certificate Type -->
                            <div class="mb-3">
                                <label for="certificate_type" class="form-label fw-bold required">Certificate Type</label>
                                <select class="form-select" name="certificate_type" id="certificate_type">
                                    <option value="Certificate of Registration">Certificate of Registration</option>
                                    <option value="Fitness Certificate">Fitness Certificate</option>
                                </select>
                                @if($errors->has('certificate_type'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('certificate_type') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Vehicle Photo -->
                            <div class="mb-3">
                                <label for="photo" class="form-label fw-bold required">Vehicle Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                                @if ($errors->has('photo'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('photo') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Vehicle Number -->
                            <div class="mb-3">
                                <label for="vehicle_number" class="form-label fw-bold required">Vehicle Number</label>
                                <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" value="{{ old('vehicle_number') }}" required>
                                @if($errors->has('vehicle_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('vehicle_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Brand -->
                            <div class="mb-3">
                                <label for="brand" class="form-label fw-bold required">Brand</label>
                                <select class="form-select" name="brand" id="brand">
                                    <option value="Toyota">Toyota</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Ford">Ford</option>
                                </select>
                                @if($errors->has('brand'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('brand') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Model -->
                            <div class="mb-3">
                                <label for="model" class="form-label fw-bold required">Model</label>
                                <select class="form-select" name="model" id="model" required>
                                    <option value="X">X</option>
                                    <option value="Y">Y</option>
                                </select>
                                @if($errors->has('model'))
                                <div class="danger">
                                    <small>{{ $errors->first('model') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Make -->
                            <div class="mb-3">
                                <label for="make" class="form-label fw-bold required">Make</label>
                                <select class="form-select" name="make" id="make" required>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                                @if($errors->has('make'))
                                <div class="danger">
                                    <small>{{ $errors->first('make') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const brands = {
            Car: `
            <option value="Toyota">Toyota</option>
            <option value="Honda">Honda</option>
            <option value="Ford">Ford</option>
        `,
            Bike: `
            <option value="Suzuki">Suzuki</option>
            <option value="Yamaha">Yamaha</option>
            <option value="Bajaj">Bajaj</option>
        `,
        };
        const models = {
            Car: `
            <option value="X">X</option>
            <option value="Y">Y</option>
            <option value="Z">Z</option>
        `,
            Bike: `
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        `,
        };

        // Dropdown elements
        const typeSelect = document.getElementById('type');
        const brandSelect = document.getElementById('brand');
        const modelSelect = document.getElementById('model');

        // Event listener to update brand options based on selected type
        typeSelect.addEventListener('change', function() {
            const selectedType = typeSelect.value;
            brandSelect.innerHTML = brands[selectedType];
        });

        // Event listener to update Model options based on selected type
        typeSelect.addEventListener('change', function() {
            const selectedType = typeSelect.value;
            modelSelect.innerHTML = models[selectedType];
        });
    </script>

    @endsection