<?php

namespace App\Repositories;

use App\Contracts\FeeRepositoryInterface;
use App\Models\Fee;
use Illuminate\Support\Collection;

class FeeRepository implements FeeRepositoryInterface {

    public function getAll(): Collection {
        return Fee::all();
    }

    public function findOrFail($id): ?Fee {
        return Fee::findOrFail($id);
    }

    public function delete($id): ?bool {
        return Fee::where('id', $id)->delete();
    }

    public function create(array $data): Fee {
        return Fee::create($data);
    }

    public function update($id, array $data): Fee {

        $fee = $this->findOrFail($id);

        $fee->update($data);

        return $fee;
    }
}
