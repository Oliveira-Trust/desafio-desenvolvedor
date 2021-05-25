<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Orders extends ResourceController {
  public function __construct() {
    $this->itemsModel = model('App\Models\ItemsModel');
    $this->clientsModel = model('App\Models\ClientsModel');
  }

  protected $modelName = 'App\Models\OrdersModel';
  protected $format = 'json';

  private $rules = [
    'client_id' => 'required|integer',
    'items'     => 'required|valid_json',
    'status'    => 'required|in_list[pending,paid,canceled]'
  ];

  public function index() {
    $rows = $this->model->findAll();

    foreach ($rows as $key => $row) {
      $value = 0;
      foreach (json_decode($row['items'], true) as $item) {
        $itemDetails = $this->itemsModel->find($item['id']);
        $value += $itemDetails['retail_price'] * $item['qty'];
      }

      $rows[$key]['value'] = $value;
      $rows[$key]['client'] = $this->clientsModel->find($row['client_id']);
    }

    return $this->respond($rows);
  }

  public function create() {
    helper(['form']);

    if (!$this->validate($this->rules)) return $this->fail($this->validator->getErrors());

    $data = [
      'client_id' => $this->request->getVar('client_id'),
      'items'     => $this->request->getVar('items'),
      'status'    => $this->request->getVar('status')
    ];

    $data['id'] = $this->model->insert($data);
    return $this->respondCreated($data);
  }

  public function show($id = 0) {
    $data = $this->model->find($id);
    $items = [];
    $value = 0;

    foreach (json_decode($data['items'], true) as $item) {
      $itemDetails = $this->itemsModel->find($item['id']);
      $value += $itemDetails['retail_price'] * $item['qty'];
      $itemDetails['quantity'] = $item['qty'];
      $items[] = $itemDetails;
    }
    
    $data['items'] = $items;
    $data['value'] = $value;

    if (!$data) return $this->failNotFound();
    return $this->respond($data);
  }

  public function update($id = 0) {
    helper(['form']);

    if (!$this->validate($this->rules)) return $this->fail($this->validator->getErrors());

    $input = $this->request->getRawInput();
    $data = [
      'id'        => $id,
      'client_id' => $input['client_id'],
      'items'     => $input['items'],
      'status'    => $input['status']
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
