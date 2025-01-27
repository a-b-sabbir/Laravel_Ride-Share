@extends('layout.layout')
@section('content')

<div class="container mt-5">
    <form method="POST" action="">
        @csrf
        <label for="license_number">License Number</label>
        <input type="text" name="license_number" id="license_number" value="{{ old('license_number', $licenseDetails['license_number'] ?? '') }}" required>

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $licenseDetails['name'] ?? '') }}" required>

        <label for="blood_group">Blood Group</label>
        <input type="text" name="blood_group" id="blood_group" value="{{ old('blood_group', $licenseDetails['blood_group'] ?? '') }}" required>

        <button type="submit">Submit</button>
    </form>
</div>
@endsection