<?php

namespace App\Traits\EloquentModel;

trait FactoryModelTrait {

        public function makeNewModel(array $data = [])
        {
                if (!is_subclass_of($model, '\Illuminate\Database\Eloquent\Model'))
                                throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model! " . __METHOD__);
                if (count($data)) $model = app()->make($this->model(), $data);
                else $model = $this->initModel();

                return $model;
        }

        protected function resetModel()
        {
                $this->getModel();
        }

        protected function initModel()
        {
                $model = app()->make($this->model());

                if (is_subclass_of($model, 'Illuminate\Database\Eloquent\Model')){
                        $this->model = $model;
                        return $this->model;
                }

                throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model! " . __METHOD__);
        }

}
