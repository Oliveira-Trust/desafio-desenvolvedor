<?php

namespace Presentation\Api\V1\Controllers;

use Application\Files\Data\{CreateFileData, GetHistoryData, SearchFileContentData};
use Application\Files\UseCases\{CreateFileUseCase ,GetHistoryUseCase, SearchFileUseCase};
use Presentation\Api\V1\Requests\Files\CreateFileRequest;
use Presentation\Api\V1\Requests\Files\GetFileHistoryRequest;
use Presentation\Api\V1\Requests\Files\SearchFileContentRequest;

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

    public function searchContent(
        SearchFileContentRequest $request,
        string $filenameOrId,
        SearchFileUseCase $usecase,
    ) {
        $attr = $request->query('s');
        $data = SearchFileContentData::from([
            's' => $attr,
            'filenameOrId' => $filenameOrId
        ]);
        $result = $usecase->execute($data);

        return $result;
    }
}
