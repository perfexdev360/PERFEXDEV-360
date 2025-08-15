@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Settings</h1>
    @if(session('status'))
        <div class="p-2 bg-green-100 text-green-800 mb-4">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Branding Name</label>
            <input type="text" name="branding_name" value="{{ old('branding_name', $settings['branding_name']) }}" class="mt-1 w-full border rounded p-2" />
        </div>
        <div>
            <label class="block text-sm font-medium">Branding Logo</label>
            <input type="text" name="branding_logo" value="{{ old('branding_logo', $settings['branding_logo']) }}" class="mt-1 w-full border rounded p-2" />
        </div>
        <div>
            <label class="block text-sm font-medium">Tax Rate (%)</label>
            <input type="number" step="0.01" name="tax_rate" value="{{ old('tax_rate', $settings['tax_rate']) }}" class="mt-1 w-full border rounded p-2" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Invoice Prefix</label>
                <input type="text" name="invoice_prefix" value="{{ old('invoice_prefix', $settings['invoice_prefix']) }}" class="mt-1 w-full border rounded p-2" />
            </div>
            <div>
                <label class="block text-sm font-medium">Next Invoice Number</label>
                <input type="number" name="invoice_next_number" value="{{ old('invoice_next_number', $settings['invoice_next_number']) }}" class="mt-1 w-full border rounded p-2" />
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium">Meeting URL Template</label>
            <input type="text" name="meeting_url_template" value="{{ old('meeting_url_template', $settings['meeting_url_template']) }}" class="mt-1 w-full border rounded p-2" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Default Currency</label>
                <input type="text" name="currency_default" value="{{ old('currency_default', $settings['currency_default']) }}" class="mt-1 w-full border rounded p-2" />
            </div>
            <div>
                <label class="block text-sm font-medium">Supported Currencies</label>
                <input type="text" name="currency_supported" value="{{ old('currency_supported', $settings['currency_supported']) }}" placeholder="USD,EUR" class="mt-1 w-full border rounded p-2" />
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium">Timezone</label>
            <input type="text" name="app_timezone" value="{{ old('app_timezone', $settings['app_timezone']) }}" class="mt-1 w-full border rounded p-2" />
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
        </div>
    </form>
@endsection
