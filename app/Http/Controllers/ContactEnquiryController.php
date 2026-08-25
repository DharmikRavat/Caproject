<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use Illuminate\Http\Request;

class ContactEnquiryController extends Controller
{
    public function index()
    {
        $enquiries = ContactEnquiry::latest()->get();
        return view('admin.contact-enquiries.index', compact('enquiries'));
    }

    public function updateStatus(Request $request, ContactEnquiry $contactEnquiry)
    {
        $validated = $request->validate(['status' => 'required|in:new,in_progress,closed']);
        $contactEnquiry->update($validated);

        return back()->with('success', 'Enquiry status updated successfully.');
    }
}
