<?php 

namespace App\Repositories;

use App\Models\Order;

class OrderRepository {

	/**
	 * Busca na tabela products os dados de acordo com filtros e busca no frontend /admin/produtos
	 *
	 * @param array $request
	 * @return void
	 */
	public function search($request){
		$model = app(Order::class);
		$query = $model->query();

        // Ordendando por campo do registro
        switch ($request['sortBy']) {
            case 'id':
            case 'total':
            case 'paid_at':
            case 'status':
            case 'created_at':
            case 'updated_at':
                $query->orderBy('orders.' . $request['sortBy'], $request['sortDirection']);
                break;
            case 'name':
                $query->orderBy('clients.name', $request['sortDirection']);
                break;
            default:
                # code...
                break;
        }

        $query->join('clients', 'orders.client_id', '=', 'clients.id')
        ->join('users', 'clients.user_id', '=', 'users.id');

        if(isset($request['info'])){
            $query->where('client_id', $request['info']);
        }

        // Pesquisando o campo dos registros
        if (!empty($request['term']) && !empty($request['field'])) {
            switch ($request['field']) {
                case 'id':
                case 'paid_at':
                case 'status':
                case 'created_at':
                case 'updated_at':
					$term = $request['term'];
					if($request['field'] == 'status'){
						switch ($request['term']) {
							case 'Aberto':
							case 'aberto':
							case 'Em Aberto':
							case 'em aberto':
							case 'EmAberto':
							case 'emaberto':
								$term = 'EM_ABERTO';
								break;
							case 'pago':
								$term = 'PAGO';
								break;
							case 'cancelado':
								$term = 'CANCELADO';
								break;
							default:
								$term = 'ERROR';
								break;
						}
					}
                    $query->where('orders.' . $request['field'] , 'LIKE', '%' . $term . '%');
                    break;
                case 'total':
                    $term = str_replace(',', '.', str_replace('.', '', $request['term'])); // formata o texto digitado como moeda R$ para float(10,2)
                    $query->where('orders.' . $request['field'] , 'LIKE', '%' . $term . '%');
                    break;
                case 'name':
                    $query->where('users.name', 'LIKE', '%' . $request['term'] . '%');
                    break;
                default:
                    # code...
                    break;
            }
        }

        return $query->paginate(10, [
                        'orders.id as oid',
                        'orders.created_at as ocreated', 
                        'orders.updated_at as oupdated',
                        'clients.id as cid',
                        'users.id as uid',
                        'users.name as uname',
                        'total',
                        'paid_at',
                        'status',
                    ]);
	}

	public function query(){
		$model = app(Order::class);
		return $model->query();
	}

	public function create($data){
		$model = app(Order::class);
		return $model->create($data);
	}



    public function createFromData($request, $total){
		$model = app(Order::class);

        $data = [
            'client_id'       =>    $request['client_id'],
            'total'           =>    $total,
            'status'          =>    $request['status'],
            'paid_at'         =>    $request['paid_at'],
        ];
        return $model->create($data);
    }

}