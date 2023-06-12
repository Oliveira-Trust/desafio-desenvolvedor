<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\Settings;

class SettingRepository
{
    public function update(int $id, array $data)
    {
        $setting = Setting::find($id);
        if ($setting) {
            return $setting->update($data);
        }
        return false;
    }

    public function findById(int $id)
    {
        return Setting::find($id);
    }

    public function getLatest()
    {
        return Setting::orderBy('id', 'desc')->first();
    }
}
