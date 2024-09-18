<?php

namespace App\Http\Controllers;

use App\Models\DataConsolidation;
use App\Models\FileControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadController extends Controller
{
    private $size = 0;

    public function upload(Request $request)
    {

        $request->validate([
            'file_uploaded' => 'required|file|mimes:csv,txt,xls,xlsx',
        ]);

        $file = $request->file('file_uploaded');

        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if (FileControl::where('fileName', $fileName)->exists()) {
            return back()->withErrors(['msg' => 'Arquivo ja processado anteriormente']);
        }

        $fileControl = new FileControl();
        $fileControl->fileName = $fileName;
        $fileControl->status = FileControl::STATUS_CREATED;
        $fileControl->save();
        $fileId = $fileControl->id;

        if (in_array($extension, ['csv', 'txt'])) {
            $this->processCsvFile($file, $fileId);
        } elseif (in_array($extension, ['xls', 'xlsx'])) {
            $this->processExcelFile($file, $fileId);
        } else {
            return back()->withErrors(['msg' => 'Formato de arquivo não suportado.']);
        }

        $fileControl->status = FileControl::STATUS_FINISH;
        $fileControl->size = $this->size;
        $fileControl->save();

        return redirect('/history');
    }

    public function history()
    {

        $headers = DB::getSchemaBuilder()->getColumnListing('file_controls');
        $files = FileControl::all();
        $fileData =  $files->toArray();

        return view('results', ['header' => $headers, 'data' => $fileData]);
    }

    public function consolidated(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchBy = $request->input('search_by');
        $perPage = $request->input('per_page', 500);

        $query = DataConsolidation::select('data');

        if ($searchTerm && in_array($searchBy, ['TckrSymb', 'RptDt'])) {
            $query->where('data->' . $searchBy, $searchTerm);
        }

        $data = $query->paginate($perPage);

        $data->getCollection()->transform(function ($item) {
            return json_decode($item->data, true);
        });

        $header = array_keys($data[0]);

        return view('resultsData', compact('header', 'data', 'searchTerm', 'searchBy', 'perPage'));
    }


    private function processCsvFile($file, $fileId) {

        $handle = fopen($file->getRealPath(), 'r');
        if ($handle === false) {
            return back()->withErrors(['msg' => 'Não foi possível abrir o arquivo.']);
        }

        $header = null;

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
                $this->size++;
            }
        }

        fclose($handle);

    }

    private function processExcelFile($file, $fileId)
    {
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();

            $header = [];
            foreach ($sheet->getRowIterator(1, 1) as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                foreach ($cellIterator as $cell) {
                    $header[] = $cell->getValue();
                }
            }

            if ($header) {
                foreach ($sheet->getRowIterator(2) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    $line = [];
                    foreach ($cellIterator as $cell) {
                        $line[] = $cell->getValue();
                    }

                    $payload = array_combine($header, $line);

                    $consolidation = new DataConsolidation();
                    $consolidation->idFile = $fileId;
                    $consolidation->data = json_encode($payload);
                    $consolidation->save();
                    $this->size++;
                }
            } else {
                return back()->withErrors(['msg' => 'Cabeçalho não encontrado no arquivo Excel.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Erro ao processar o arquivo Excel: ' . $e->getMessage()]);
        }
    }

    private function isValidFile($line)
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
