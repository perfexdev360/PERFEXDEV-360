<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = [
            'branding_name' => config('settings.branding.name'),
            'branding_logo' => config('settings.branding.logo'),
            'tax_rate' => config('settings.tax.rate'),
            'invoice_prefix' => config('settings.invoice.prefix'),
            'invoice_next_number' => config('settings.invoice.next_number'),
            'meeting_url_template' => config('settings.meeting.url_template'),
            'currency_default' => config('settings.currency.default'),
            'currency_supported' => config('settings.currency.supported'),
            'app_timezone' => config('settings.app.timezone'),
        ];

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'branding_name' => ['nullable', 'string'],
            'branding_logo' => ['nullable', 'string'],
            'tax_rate' => ['nullable', 'numeric'],
            'invoice_prefix' => ['nullable', 'string'],
            'invoice_next_number' => ['nullable', 'integer'],
            'meeting_url_template' => ['nullable', 'string'],
            'currency_default' => ['nullable', 'string'],
            'currency_supported' => ['nullable', 'string'],
            'app_timezone' => ['nullable', 'string'],
        ]);

        $mapping = [
            'branding.name' => 'branding_name',
            'branding.logo' => 'branding_logo',
            'tax.rate' => 'tax_rate',
            'invoice.prefix' => 'invoice_prefix',
            'invoice.next_number' => 'invoice_next_number',
            'meeting.url_template' => 'meeting_url_template',
            'currency.default' => 'currency_default',
            'currency.supported' => 'currency_supported',
            'app.timezone' => 'app_timezone',
        ];

        foreach ($mapping as $key => $field) {
            Setting::updateOrCreate(['key' => $key], ['value' => $data[$field] ?? null]);
        }

        return redirect()->route('admin.settings.edit')->with('status', 'Settings updated.');
    }
}
