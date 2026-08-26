<?php

namespace Tests\Feature;

use App\Models\ContactEnquiry;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentConnectivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_service_is_visible_and_deactivated_service_is_hidden(): void
    {
        $service = Service::create([
            'title' => 'Test Compliance Service',
            'slug' => 'test-compliance-service',
            'category' => 'direct_tax',
            'description' => 'Test description',
            'is_active' => true,
        ]);

        $this->get(route('service.show', $service->slug))->assertOk()->assertSee($service->title);

        $service->update(['is_active' => false]);

        $this->get(route('service.show', $service->slug))->assertNotFound();
    }

    public function test_contact_form_persists_an_enquiry(): void
    {
        $payload = [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'phone' => '+91 70000 00000',
            'subject' => 'Service enquiry',
            'message' => 'Please contact me about your services.',
        ];

        $this->post(route('contact.submit'), $payload)->assertRedirect();

        $this->assertDatabaseHas('contact_enquiries', [
            'email' => $payload['email'],
            'subject' => $payload['subject'],
            'status' => 'new',
        ]);
        $this->assertSame(1, ContactEnquiry::where('email', $payload['email'])->count());
    }
}