<?php

namespace App\Services;

use App\Http\Resources\InstrumentsConsolidatedFileCollection;
use App\Imports\InstrumentsConsolidatedImport;
use App\Models\InstrumentsConsolidatedFile;
use App\Models\InstrumentsConsolidatedUploadHistory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

class InstrumentsConsolidatedFileService
{
    public function searchContent(array $filters): InstrumentsConsolidatedFileCollection|Collection
    {
        if(empty($filters))
            return new InstrumentsConsolidatedFileCollection(
                InstrumentsConsolidatedFile::paginate(100)
            );

        return InstrumentsConsolidatedFile::where($filters)
            ->get();
    }

    private function saveUploadHistory(UploadedFile $file): void
    {
        InstrumentsConsolidatedUploadHistory::query()->create(
            [
                'filename' => $file->getClientOriginalName(),
            ]
        );
    }

    public function upload(UploadedFile $file): void
    {
        $this->saveUploadHistory($file);
        Excel::queueImport(new InstrumentsConsolidatedImport, $file);
    }

    public function searchUploadedFileHistory(array $filter): Collection
    {
        $query = InstrumentsConsolidatedUploadHistory::query();
        if(isset($filter['created_at']))
            $query->whereDate(
                'created_at',
                '=',
                $filter['created_at']
            );

        if(isset($filter['filename']))
            $query->where(
                'filename',
                '=',
                $filter['filename']
            );
        return $query->get();
    }
}
