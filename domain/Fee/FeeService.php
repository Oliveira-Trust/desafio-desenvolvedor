<?php

namespace Oliveiratrust\Fee;

use Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use Oliveiratrust\Models\Fee\Fee;

class FeeService {

    use AuthorizesRequests;

    public function __construct(
        private Fee $model
    )
    {
    }

    public function create(array $data): Fee
    {
        Gate::authorize('can-create-fees');

        $data = $this->validate($data);

        return $this->model->create($data);
    }

    public function update($id, array $data): bool
    {
        $fee = $this->model->find($id);

        $this->authorize('update', $fee);

        $data = $this->validate($data);

        return $fee->update($data);
    }

    public function delete($id): bool
    {
        $fee = $this->model->find($id);

        $this->authorize('destroy', $fee);

        return $fee->delete();
    }

    private function validate($data)
    {
        if ($data['min_amount'] >= $data['max_amount']) {
            throw ValidationException::withMessages([
                'max_amount' => 'Valor máximo deve ser maior que o valor mínimo.',
            ]);
        }

        if ($data['percent'] == 0 && $data['fixed_value'] == 0) {
            throw ValidationException::withMessages([
                'percent' => 'Informe uma taxa em porcentagem ou uma taxa fixa',
            ]);
        }

        if ($data['fee_type_id'] == 2) {
            $data['payment_type_id'] = null;
        }

        return $data;
    }
}
