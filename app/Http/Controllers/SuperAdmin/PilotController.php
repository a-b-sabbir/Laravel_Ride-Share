<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Pilot\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilotController extends Controller
{

    public function unassignedPilotShow($id)
    {
        $pilot = Pilot::with(['user', 'license'])->findOrFail($id);

        return view('roles.super_admin.pilots_info.show', compact('pilot'));
    }
    public function assignedPilotShow($id)
    {
        $pilot = Pilot::with(['user', 'license', 'assignments.vehicle'])->findOrFail($id);

        return view('roles.super_admin.pilots_info.show', compact('pilot'));
    }

    public function editBasic(Request $request, Pilot $pilot)
    {
        return view('roles.pilot.edit.basic', compact('pilot'));
    }

    public function updateBasic(Request $request, Pilot $pilot)
    {
        $validatedData = $request->validate([
            'profile_photo' => 'sometimes|required|image|mimes:jpg,png,jpeg|max:5000',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required',
            'nid' => ['required', 'string', 'regex:/^\d{10}$|^\d{13}$|^\d{17}$/'],
            'nid_image' => 'sometimes|required|image|mimes:jpg,png,jpeg|max:5000',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string|max:14',
            'relation_with_emergency_contact' => 'nullable|string',
            'preferred_shift' => 'nullable|in:day,night,flexible',
        ]);

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo'] = $profilePhotoPath;
        }

        if ($request->hasFile('nid_image')) {
            $nidImagePath = $request->file('nid_image')->store('nid_images', 'public');
            $validatedData['nid_image'] = $nidImagePath;
        }

        DB::beginTransaction();

        $userData = [
            'name' => $validatedData['name'] ?? $pilot->user->name, // Preserve old if not updated
            'email' => $validatedData['email'] ?? $pilot->user->email,
            'phone_number' => $validatedData['phone_number'] ?? $pilot->user->phone_number,
            'profile_photo' => $validatedData['profile_photo'] ?? $pilot->user->profile_photo, // Preserve old if not updated
        ];

        $pilot->user->update($userData);

        $pilotData = [
            'nid' => $validatedData['nid'] ?? $pilot->nid,
            'nid_image' => $validatedData['nid_image'] ?? $pilot->nid_image,
            'emergency_contact_name' => $validatedData['emergency_contact_name'] ?? $pilot->emergency_contact_name,
            'emergency_contact_number' => $validatedData['emergency_contact_number'] ?? $pilot->emergency_contact_number,
            'relation_with_emergency_contact' => $validatedData['relation_with_emergency_contact'] ?? $pilot->relation_with_emergency_contact,
            'preferred_shift' => $validatedData['preferred_shift'] ?? $pilot->preferred_shift,
        ];

        $pilot->update($pilotData);

        DB::commit();

        return redirect()->route('unassigned-pilot.show', $pilot->id)->with('success', 'Pilot information updated successfully.');
    }

    public function editLicense(Request $request, Pilot $pilot)
    {
        return view('roles.pilot.edit.license', compact('pilot'));
    }

    public function updateLicense(Request $request, Pilot $pilot)
    {

        $validatedData = $request->validate([
            'license_photo' => 'sometimes|required|image|mimes:jpg,png,jpeg|max:5000',
            'type' => 'required|in:Professional,Non-Professional',
            'name' => 'required|string|min:3|max:100',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'blood_group' => 'required|string',
            'father_or_husband_name' => 'required|string|min:3|max:100',
            'license_number' => 'required|unique:pilot_licenses,license_number,' . $pilot->license->id . '|min:5|max:20',
            'issue_date' => 'required|date|before_or_equal:today',
            'expiry_date' => 'required|date|after:today',
            'ref_no' => 'nullable|int',
            'issuing_authority' => 'required'
        ]);


        if ($request->hasFile('license_photo')) {
            $licensePhotoPath = $request->file('license_photo')->store('license_photos', 'public');
            $validatedData['license_photo'] = $licensePhotoPath;
        }

        DB::beginTransaction();

        $pilot->license->update($validatedData);

        DB::commit();

        return redirect()->route('unassigned-pilot.show', $pilot->id)->with('success', 'Pilot information updated successfully.');
    }

    public function updateUnassignedPilotStatus(Request $request, $pilotID)
    {

        $request->validate([
            'status' => 'required|in:Active,Suspended,Deactivated'
        ]);


        $pilot = Pilot::findOrFail($pilotID);

        $pilot->account_status = $request->input('status');
        $pilot->save();

        return redirect()->back()->with('success', 'Pilot status updated successfully.');
    }
    public function updatePilotStatus(Request $request, $pilotID)
    {

        $request->validate([
            'status' => 'required|in:Active,Suspended,Deactivated'
        ]);


        $pilot = Pilot::findOrFail($pilotID);

        $pilot->account_status = $request->input('status');
        $pilot->save();
        $pilot->assignments->status = $request->input('status');
        $pilot->assignments->save();

        return redirect()->back()->with('success', 'Pilot status updated successfully.');
    }


    public function updatePilotApproval(Request $request, $pilotID)
    {
        $request->validate([
            'approval' => 'required|boolean'
        ]);


        $pilot = Pilot::findOrFail($pilotID);

        $pilot->approval = $request->input('approval');
        $pilot->save();

        return redirect()->back()->with('success', 'Pilot status updated successfully.');
    }

    public function updatePilotBackgroundCheckStatus(Request $request, $pilotID)
    {
        $request->validate([
            'background_check_status' => 'required|in:Pending,Passed,Failed'
        ]);

        $pilot = Pilot::findOrFail($pilotID);
        $pilot->background_check_status = $request->input('background_check_status');

        $pilot->save();

        if ($pilot->background_check_status === 'Passed') {
            return redirect()->route('super_admin-assign-pilot-to-vehicle.create');
        }
        return redirect()->back()->with('success', 'Pilot background check status updated successfully.');
    }
}
