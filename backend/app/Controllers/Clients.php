<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Clients extends ResourceController {
  protected $modelName = 'App\Models\ClientsModel';
  protected $format = 'json';

  private $rules = [
    'name'     => 'required',
    'document' => 'required',
    'email'    => 'valid_email'
  ];

  public function index() {
    $rows = $this->model->findAll();
    return $this->respond($rows);
  }

  public function create() {
    helper(['form']);

    if (!$this->validate($this->rules)) return $this->fail($this->validator->getErrors());

    $data = [
      'name'     => $this->request->getVar('name'),
      'document' => $this->request->getVar('document'),
      'email'    => $this->request->getVar('email'),
      'birthday' => $this->request->getVar('birthday'),
      'phone'    => $this->request->getVar('phone')
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
      'id'       => $id,
      'name'     => $input['name'],
      'document' => $input['document'],
      'email'    => $input['email'],
      'birthday' => $input['birthday'],
      'phone'    => $input['phone']
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
