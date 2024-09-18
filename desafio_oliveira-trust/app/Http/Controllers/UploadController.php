<?php

namespace App\Http\Controllers;

use App\Models\DataConsolidation;
use Illuminate\Http\Request;
use stdClass;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        $fileName = $file->getClientOriginalName();

        $header = null;
        $data = [];

        $handle = fopen($file->getRealPath(), 'r');
        if ($handle === false) {
            return back()->withErrors(['msg' => 'Não foi possível abrir o arquivo.']);
        }

        while (($line = fgets($handle)) !== FALSE) {
            if ($this->isValidFile($line)) {
                $header = str_getcsv($line, ';');
                break;
            }
        }

        if($header) {
            while (($line = fgetcsv($handle, 0, ';')) !== FALSE) {
                $payload = array_combine($header, $line);
                
                DataConsolidation::insert([
                    'fileName' => $fileName,
                    'data' => json_encode($payload)
                ]);
            }
        }


        fclose($handle);

        return view('results', ['header' => $header, 'data' => $data]);
    }

    function isValidFile($line) {
        $columns = str_getcsv($line, ';');
        foreach($columns as $c) {
            if(empty($c)){
                return false;
            }
        }
        return true;
    }
}