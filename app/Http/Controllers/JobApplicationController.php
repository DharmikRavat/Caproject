<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('career')->latest()->get();
        return view('admin.job-applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, JobApplication $jobApplication)
    {
        $validated = $request->validate(['status' => 'required|in:new,reviewing,shortlisted,rejected,hired']);
        $jobApplication->update($validated);

        return back()->with('success', 'Application status updated successfully.');
    }
}
