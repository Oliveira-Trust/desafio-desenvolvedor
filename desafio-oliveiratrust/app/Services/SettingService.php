<?php


namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function updateSetting(int $id, array $data)
    {
        return $this->settingRepository->update($id, $data);
    }

    public function getSettingById(int $id)
    {
        return $this->settingRepository->findById($id);
    }

    public function getLatestSetting()
    {
        return $this->settingRepository->getLatest();
    }
}
