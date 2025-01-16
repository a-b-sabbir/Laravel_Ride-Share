<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use thiagoalessio\TesseractOCR\TesseractOCR;

class TaxTokenController extends Controller
{
    public function showInfo(Request $request)
    {
        $validatedData = $request->validate([
            'tax_token_photo' => 'required|image|mimes:jpg,png,jpeg|max:4000'
        ]);

        $taxTokenPhotoPath = $request->file('tax_token_photo')->store('tax_token_photo', 'public');

        // Run OCR to extract details
        $ocrText = (new TesseractOCR(storage_path('app/public/' . $taxTokenPhotoPath)))
            ->lang('ben+eng')
            ->run();

        // Extract details from OCR text
        $details = $this->extractDetailsFromText($ocrText);

        // Commit the transaction
        DB::commit();

        // Redirect to the form view with extracted details
        return view('vehicle.tax-token-form', ['details' => $details]);
    }

    // Helper method to extract details from OCR text
    private function extractDetailsFromText($text)
    {
        return [
            'registration_number' => $this->extractData($text, 'Registration Number'),
            'registration_date' => $this->extractData($text, 'Registration Date'),
            'tax_token_number' => $this->extractData($text, 'Tax Token Number'),
            'transaction_no' => $this->extractData($text, 'Transaction No.'),
            'eTracking_no' => $this->extractData($text, 'eTracking No.'),
            'issuing_bank_name' => $this->extractData($text, 'Issuing Bank Name'),
        ];
    }

    private function extractData($text, $label)
    {
        if (preg_match("/($label)\s*[:\-\/]*\s*([^\n]+)/iu", $text, $matches)) {
            return trim($matches[2] ?? '');
        }
    }
}
