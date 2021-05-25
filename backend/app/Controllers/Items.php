<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Items extends ResourceController {
  protected $modelName = 'App\Models\ItemsModel';
  protected $format = 'json';

  private $rules = [
    'description'  => 'required',
    'cost_price'   => 'required|numeric',
    'retail_price' => 'required|numeric'
  ];

  public function index() {
    $rows = $this->model->findAll();
    return $this->respond($rows);
  }

  public function create() {
    helper(['form']);

    if (!$this->validate($this->rules)) return $this->fail($this->validator->getErrors());

    $data = [
      'description'  => $this->request->getVar('description'),
      'cost_price'   => $this->request->getVar('cost_price'),
      'retail_price' => $this->request->getVar('retail_price')
    ];

    $data['id'] = $this->model->insert($data);
    return $this->respondCreated($data);
  }

  public function show($id = 0) {
    $data = $this->model->find($id);
    if (!$data) return $this->failNotFound();
    return $this->respond($data);
  }

  public function update($id = 0) {
    helper(['form']);

    if (!$this->validate($this->rules)) return $this->fail($this->validator->getErrors());

    $input = $this->request->getRawInput();
    $data = [
      'id'           => $id,
      'description'  => $input['description'],
      'cost_price'   => $input['cost_price'],
      'retail_price' => $input['retail_price']
    ];

    $this->model->save($data);
    return $this->respond($data);
  }

  public function delete($id = 0) {
    $data = $this->model->find($id);

    if (!$data) return $this->failNotFound();

    $this->model->delete($id);
    return $this->respondDeleted($data);
  }
}
