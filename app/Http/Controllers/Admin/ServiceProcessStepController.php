<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProcessStep;
use Illuminate\Http\Request;

class ServiceProcessStepController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'integer',
        ]);

        ServiceProcessStep::create($validated);
        return redirect()->route('admin.services.content', $request->service_id)->with('success', 'Process Step added successfully.');
    }

    public function update(Request $request, ServiceProcessStep $serviceProcessStep)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'integer',
        ]);

        $serviceProcessStep->update($validated);
        return redirect()->route('admin.services.content', $serviceProcessStep->service_id)->with('success', 'Process Step updated successfully.');
    }

    public function destroy(ServiceProcessStep $serviceProcessStep)
    {
        $serviceId = $serviceProcessStep->service_id;
        $serviceProcessStep->delete();
        return redirect()->route('admin.services.content', $serviceId)->with('success', 'Process Step deleted successfully.');
    }
}
