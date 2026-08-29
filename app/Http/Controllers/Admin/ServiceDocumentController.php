<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceDocument;
use Illuminate\Http\Request;

class ServiceDocumentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        ServiceDocument::create($validated);
        return redirect()->route('admin.services.content', $request->service_id)->with('success', 'Document added successfully.');
    }

    public function update(Request $request, ServiceDocument $serviceDocument)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $serviceDocument->update($validated);
        return redirect()->route('admin.services.content', $serviceDocument->service_id)->with('success', 'Document updated successfully.');
    }

    public function destroy(ServiceDocument $serviceDocument)
    {
        $serviceId = $serviceDocument->service_id;
        $serviceDocument->delete();
        return redirect()->route('admin.services.content', $serviceId)->with('success', 'Document deleted successfully.');
    }
}
