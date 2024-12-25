@extends('layout.layout')
@section('content')

<form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Name: </label>
    <input type="text" id="name" name="name" value="{{ old('name') }}">
    @error('name')
    <div>{{ $message }}</div>
    @enderror
    <br>
    
    <label for="email">Email: </label>
    <input type="email" id="email" name="email" value="{{ old('name') }}">
    @error('email')
    <div>{{ $message }}</div>
    @enderror
    <br>

    <label for="profile_picture">Profile Picture</label>
    <input type="file" name="profile_picture" id="profile_picture">
    @error('profile_picture')
    <div>{{ $message }}</div>
    @enderror
    <br>

    <button type="submit">Submit</button>
</form>
@endsection