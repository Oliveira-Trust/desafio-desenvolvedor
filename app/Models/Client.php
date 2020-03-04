<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = ['name','email'];

    public function saveAndValidate($request)
    {
        $this->validate($request);
        if(!empty($request->clientId)){
            $client = new Client();
            $clientSave = $client->find($request->clientId);
            $clientSave->name = $request->name;
            $clientSave->email = $request->email;
            return $clientSave->save();
        }
        $this->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);
        if($this->save()){
            return ["success" => "Cliente criado com sucesso!"];
        }
        return ["error" => "Cliente não pode ser criado!"];
    }

    private function validate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    }
}
