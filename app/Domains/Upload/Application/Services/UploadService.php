<?php

namespace App\Domains\Upload\Application\Services;

use App\Domains\Upload\Exceptions\DuplicateUploadException;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use Illuminate\Http\UploadedFile;

final class UploadService
{
    public function uploadList(): array
    {
        return [
            [
                'id' => 1,
                'filename' => 'clientes.csv',
                'path' => 'uploads/clientes.csv',
                'size' => 45000,
                'mime_type' => 'text/csv',
                'created_at' => '2026-03-21 09:00:00',
            ],
            [
                'id' => 2,
                'filename' => 'vendas_2024.xlsx',
                'path' => 'uploads/vendas_2024.xlsx',
                'size' => 1024000,
                'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'created_at' => '2026-03-21 10:30:00',
            ],
            [
                'id' => 3,
                'filename' => 'produtos.csv',
                'path' => 'uploads/produtos.csv',
                'size' => 128000,
                'mime_type' => 'text/csv',
                'created_at' => '2026-03-21 11:45:00',
            ],
            [
                'id' => 4,
                'filename' => 'relatorio_financeiro.xlsx',
                'path' => 'uploads/relatorio_financeiro.xlsx',
                'size' => 2048000,
                'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'created_at' => '2026-03-21 14:20:00',
            ],
            [
                'id' => 5,
                'filename' => 'estoque.csv',
                'path' => 'uploads/estoque.csv',
                'size' => 67000,
                'mime_type' => 'text/csv',
                'created_at' => '2026-03-21 16:00:00',
            ],
        ];
    }

    public function fileExists(string $fileMd5): bool
    {
        return Upload::query()
            ->where('file_md5', $fileMd5)
            ->exists();
    }

    public function uploadFile(UploadedFile $file): Upload
    {
        $fileMd5 = $this->calculateHash($file);

        if ($this->fileExists($fileMd5)) {
            throw new DuplicateUploadException();
        }

        $path = $file->store('uploads');

        return Upload::create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
            'size' => $file->getSize(),
            'file_md5' => $fileMd5,
            'status' => Upload::STATUS_PENDING,
        ]);
    }


    public function calculateHash(UploadedFile $file): string
    {
        $filePath = $file->getRealPath();

        if ($filePath === false) {
            throw new \RuntimeException('Não foi possível acessar o arquivo enviado.');
        }

        $fileMd5 = md5_file($filePath);

        if ($fileMd5 === false) {
            throw new \RuntimeException('Não foi possível calcular o hash do arquivo.');
        }

        return $fileMd5;
    }
}