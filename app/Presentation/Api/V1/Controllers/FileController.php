<?php

namespace Presentation\Api\V1\Controllers;

use Application\Files\Data\CreateFileData;
use Application\Files\UseCases\CreateFileUseCase;
use Application\Files\UseCases\GetHistoryUseCase;
use Illuminate\Http\Request;
use Presentation\Api\V1\Requests\Files\CreateFileRequest;

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

    public function getHistory(Request $request, GetHistoryUseCase $usecase) {
        // TODO
    }
}
