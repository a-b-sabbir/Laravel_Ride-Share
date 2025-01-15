<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use thiagoalessio\TesseractOCR\TesseractOCR;

class RegistrationPaperController extends Controller
{
    public function uploadImage(Request $request)
    {
        $validatedData = $request->validate([
            'registration_photo' => 'required|image|mimes:jpg,png,jpeg|max:5000'
        ]);

        try {

            // Store the uploaded photo
            $registrationPhotoPath = $request->file('registration_photo')->store('registration_photo', 'public');

            // Run OCR to extract details
            $ocrText = (new TesseractOCR(storage_path('app/public/' . $registrationPhotoPath)))
                ->lang('ben+eng')
                ->run();

            // Extract details from OCR text
            $details = $this->extractDetailsFromText($ocrText);

            // Commit the transaction
            DB::commit();

            // Redirect to the form view with extracted details
            return view('vehicle.registration_paper_form', ['details' => $details]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Something went wrong!']);
        }
    }

    // Helper method to extract details from OCR text
    private function extractDetailsFromText($text)
    {
        return [
            'vehicle_class' => $this->extractData($text, 'যানের শ্রেণি|Vehicle Class'),
            'color' => $this->extractData($text, 'রং|Color'),
            'registration_no' => $this->extractData($text, 'রেজিস্ট্রেশন নম্বর|Registration No'),
            'engine_no' => $this->extractData($text, 'ইঞ্জিন নম্বর|Engine No'),
            'date' => $this->extractData($text, 'তারিখ|Date'),
        ];
    }

    private function extractData($text, $label)
    {
        if (preg_match("/($label)\s*[:\-\/]*\s*([^\n]+)/iu", $text, $matches)) {
            return trim($matches[2] ?? '');
        }
    }
}
