<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CustomerFilters extends QueryFilters
{

    /**
     * Filter by cpf.
     *
     * @param  string $cpf
     * @return Builder
     */
    public function cpf($cpf)
    {
        return $this->builder->where('cpf', $cpf);
    }

    /**
     * Filter by name.
     *
     * @param  string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->where('name','like', '%'.$name.'%');
    }

    /**
     * @param $email
     * @return Builder
     */
    public function email($email)
    {
        return $this->builder->where('email','like', '%'.$email.'%');
    }

}
