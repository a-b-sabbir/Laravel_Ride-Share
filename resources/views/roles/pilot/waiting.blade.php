@extends('layout.layout')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h2 class="text-2xl font-semibold text-gray-800">Your Application is Under Review</h2>
        <p class="text-gray-600 mt-2">
            Thank you for completing your registration. Our team is reviewing your details, and we will notify you once your account is approved.
        </p>

        <div class="mt-4">
            <img src="" alt="Waiting for Approval" class="w-64 mx-auto">
        </div>

        <p class="text-gray-500 mt-4">Approval usually takes <strong>24-48 hours</strong>. Please be patient.</p>

        <p class="text-gray-400 text-sm mt-4">
            Need help? <a href="mailto:support@example.com" class="text-blue-500">Contact Support</a>
        </p>
    </div>
</div>
@endsection