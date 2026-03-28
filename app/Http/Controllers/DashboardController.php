<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\ProcessInstrumentFile;
use App\Models\FileUpload;
use App\Services\FileProcessingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly FileProcessingService $service)
    {
    }

    public function index(Request $request): View
    {
        $query = FileUpload::orderBy('created_at', 'desc');

        if ($request->filled('name')) {
            $query->byName($request->name);
        }

        if ($request->filled('reference_date')) {
            $query->byReferenceDate($request->reference_date);
        }

        $uploads = $query->paginate(10)->withQueryString();

        return view('dashboard', compact('uploads'));
    }

    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,xlsx,xls,txt', 'max:102400'],
        ]);

        $file = $request->file('file');
        $hash = $this->service->hashFile($file->getRealPath());

        if (FileUpload::where('hash', $hash)->exists()) {
            return back()->withErrors(['file' => 'Este arquivo já foi enviado anteriormente.']);
        }

        $extension = $file->getClientOriginalExtension();
        $storedName = Str::random(40) . '.' . $extension;
        $file->storeAs('uploads', $storedName, 'local');
        $referenceDate = $this->service->extractReferenceDate($file->getClientOriginalName());

        $upload = FileUpload::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'hash' => $hash,
            'status' => FileUpload::STATUS_PENDING,
            'reference_date' => $referenceDate,
            'total_records' => 0,
            'processed_records' => 0,
            'uploaded_by' => (string)$request->user()->id,
        ]);

        ProcessInstrumentFile::dispatch((string)$upload->_id, $storedName);

        return back()->with('success', 'Arquivo enviado e enfileirado para processamento!');
    }
}
