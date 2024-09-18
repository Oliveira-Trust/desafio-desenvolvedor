<?php

namespace App\Http\Controllers;

use App\Models\DataConsolidation;
use App\Models\FileControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $fileControl = new FileControl();
        $fileControl->fileName = $fileName;
        $fileControl->status = FileControl::STATUS_CREATED;
        $fileControl->save();
        $fileId = $fileControl->id;

        $header = null;
        $size = 0;

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

        if ($header) {
            while (($line = fgetcsv($handle, 0, ';')) !== FALSE) {
                $payload = array_combine($header, $line);

                $consolidation = new DataConsolidation();
                $consolidation->idFile = $fileId;
                $consolidation->data = json_encode($payload);
                $consolidation->save();
                $size++;
            }
        }

        $fileControl->status = FileControl::STATUS_FINISH;
        $fileControl->size = $size;
        $fileControl->save();

        fclose($handle);

        return redirect('/history');
    }

    public function history() {

        $headers = DB::getSchemaBuilder()->getColumnListing('file_controls');
        $files = FileControl::all();
        $fileData =  $files->toArray();

        return view('results', ['header' => $headers, 'data' => $fileData]);
    }

    function isValidFile($line)
    {
        $columns = str_getcsv($line, ';');
        foreach ($columns as $c) {
            if (empty($c)) {
                return false;
            }
        }
        return true;
    }
}
