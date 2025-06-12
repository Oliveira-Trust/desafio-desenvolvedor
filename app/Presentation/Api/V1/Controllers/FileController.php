<?php

namespace Presentation\Api\V1\Controllers;

use Application\Files\Data\{CreateFileData, GetHistoryData};
use Application\Files\UseCases\{CreateFileUseCase ,GetHistoryUseCase};
use Presentation\Api\V1\Requests\Files\CreateFileRequest;
use Presentation\Api\V1\Requests\Files\GetFileHistoryRequest;

class FileController {
    public function storeFile(
        CreateFileRequest $request,
        CreateFileUseCase $usecase,
    ) {
        $file = $request->file('file');
        $data = new CreateFileData($file);
        $result = $usecase->execute($data);

        return $result;
    }

    public function getHistory(
        GetFileHistoryRequest $request,
        GetHistoryUseCase $usecase,
    ) {
        $requestData = $request->only(['filename', 'date']);
        $data = GetHistoryData::from($requestData );
        $result = $usecase->execute($data);

        return $result;
    }
}
