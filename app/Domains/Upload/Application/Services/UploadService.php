<?php

namespace App\Domains\Upload\Application\Services;

use Illuminate\Http\UploadedFile;

final class UploadService
{
    public function uploadFile(UploadedFile $file): string
    {
        return $file->store('uploads');
    }

    public function uploadList()
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
}
