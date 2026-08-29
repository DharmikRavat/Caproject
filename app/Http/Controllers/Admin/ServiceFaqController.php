<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;

class ServiceFaqController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'integer',
        ]);

        ServiceFaq::create($validated);
        return redirect()->route('admin.services.content', $request->service_id)->with('success', 'FAQ added successfully.');
    }

    public function update(Request $request, ServiceFaq $serviceFaq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'integer',
        ]);

        $serviceFaq->update($validated);
        return redirect()->route('admin.services.content', $serviceFaq->service_id)->with('success', 'FAQ updated successfully.');
    }

    public function destroy(ServiceFaq $serviceFaq)
    {
        $serviceId = $serviceFaq->service_id;
        $serviceFaq->delete();
        return redirect()->route('admin.services.content', $serviceId)->with('success', 'FAQ deleted successfully.');
    }
}
