<?php 

namespace App\Repositories;

use App\Models\Client;

class ClientRepository {

	/**
	 * Busca na tabela clients os dados de acordo com filtros e busca no frontend /admin/clientes
	 *
	 * @param array $request
	 * @return void
	 */
	public function search($request){
		$model = app(Client::class);
		$query = $model->query();

        // Ordendando por campo do registro
        switch ($request['sortBy']) {
            case 'id':
            case 'phone_number':
            case 'phone_number2':
            case 'birth':
                $query->orderBy('clients.' . $request['sortBy'], $request['sortDirection']);
                break;
            case 'city_id':
                $query->orderBy('cities.name', $request['sortDirection']);
                break;
            case 'name':
            case 'enable':
            case 'created_at':
            case 'updated_at':
                $query->orderBy('users.' . $request['sortBy'], $request['sortDirection']);
                break;
            default:
                # code...
                break;
        }

        $query->join('users', 'clients.user_id', '=', 'users.id')
        ->join('cities', 'clients.city_id', '=', 'cities.id');

        // Pesquisando o campo dos registros
        if (!empty($request['term']) && !empty($request['field'])) {
            switch ($request['field']) {
                case 'id':
                case 'phone_number':
                case 'phone_number2':
                case 'birth':
                    $query->where('clients.' . $request['field'] , 'LIKE', '%' . $request['term'] . '%');
                    break;
                case 'city_id':
                    $query->where('cities.name', 'LIKE', '%' . $request['term'] . '%');
                    break;
                case 'name':
                case 'enable':
                case 'created_at':
                case 'updated_at':
                    $query->where('users.' . $request['field'] , 'LIKE', '%' . $request['term'] . '%');
                    break;
                default:
                    # code...
                    break;
            }
        }

        return $query->paginate(10, [
                        'clients.id as cid',
                        'users.id as uid',
                        'users.name as uname',
                        'users.created_at as ucreated', 
                        'users.updated_at as uupdated',
                        'cities.id as ciid', 
                        'cities.name as ciname', 
                        'cities.created_at as ccreated', 
                        'cities.updated_at as cupdated',
                        'birth', 
                        'phone_number', 
                        'phone_number2', 
                        'enable', 
                    ]);
	}

	public function query(){
		$model = app(Client::class);
		return $model->query();
	}


}