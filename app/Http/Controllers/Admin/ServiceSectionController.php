<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceSection;
use Illuminate\Http\Request;

class ServiceSectionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'integer',
        ]);

        ServiceSection::create($validated);
        return redirect()->route('admin.services.content', $request->service_id)->with('success', 'Section added successfully.');
    }

    public function update(Request $request, ServiceSection $serviceSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'integer',
        ]);

        $serviceSection->update($validated);
        return redirect()->route('admin.services.content', $serviceSection->service_id)->with('success', 'Section updated successfully.');
    }

    public function destroy(ServiceSection $serviceSection)
    {
        $serviceId = $serviceSection->service_id;
        $serviceSection->delete();
        return redirect()->route('admin.services.content', $serviceId)->with('success', 'Section deleted successfully.');
    }
}
