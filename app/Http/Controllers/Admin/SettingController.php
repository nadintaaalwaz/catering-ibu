<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate(['id' => 1], [
            'business_name' => 'Dapur Ibu',
            'whatsapp_number' => '6285875206802',
        ]);

        return Inertia::render('Admin/Settings', ['setting' => $setting]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'business_name' => ['required', 'string', 'max:100'],
            'whatsapp_number' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'opening_hours' => ['nullable', 'string', 'max:150'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'about' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['whatsapp_number'] = $this->normalizeWa($data['whatsapp_number']);

        Setting::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

  
    private function normalizeWa(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if (str_starts_with($digits, '0')) {
            return '62'.substr($digits, 1);
        }

        if (str_starts_with($digits, '8')) {
            return '62'.$digits;
        }

        return $digits;
    }
}