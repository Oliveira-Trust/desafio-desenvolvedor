<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repository\Product\CategoryDTO;
use App\Repository\Product\CategoryIRepository;

class CategoryController extends Controller
{
    private $categoryIRepository;

    public function __construct(
        CategoryIRepository $categoryIRepository
    )
    {
        $this->categoryIRepository = $categoryIRepository;
        $this->middleware('auth:api');
    }

    public function index(Request $request) {
        return $this->categoryIRepository->readAll();
    }

    public function show(Request $request, $id) {
        $category = $this->categoryIRepository->read($id);

        if ($category === []) {
            return response()->json( [
                "message" => "Not found."
            ], 404);
        }

        return $category;
    }

    public function store(Request $request) {

        //validate incoming request
        $this->validate($request, CategoryDTO::rules());

        try
        {
            $category = new CategoryDTO($request->all());
            $this->categoryIRepository->create($category);

            return response()->json( [
                'entity' => 'category',
                'action' => 'store',
                'result' => 'success'
            ], 201);

        }
        catch (\Exception $e)
        {
            return response()->json( [
                'entity' => 'category',
                'action' => 'store',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }

    public function update(Request $request, $id) {
        $category = $this->categoryIRepository->read($id);

        if ($category === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        $this->validate($request, CategoryDTO::rulesUpdate($id));

        try {
            $categoryDTO = new CategoryDTO($request->all());
            $categoryUpdated = $this->categoryIRepository->update($id, $categoryDTO);

            if ($categoryUpdated == $category) {
                return response()->json( [
                    "message" => "Nothing to change."
                ], 400);
            }

            return response()->json( $categoryUpdated, 200);

        } catch (\Exception $e) {
            return response()->json( [
                'entity' => 'category',
                'action' => 'update',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }


    public function delete(Request $request, $id) {
        $category = $this->categoryIRepository->read($id);

        if ($category === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        if ($this->categoryIRepository->delete($id)) {
            return response()->json( ["message" => "success"], 200);
        }
        return response()->json( ["message" => "Error"], 400);
    }

    public function deleteArray(Request $request) {

        if (!isset($request->ids) || count($request->ids) == 0) {
            return response()->json( ["message" => "Empty ids."], 422);
        }

        $categories = $this->categoryIRepository->readArray($request->ids);

        if ($categories === []) {
            return response()->json( ["message" => "Not found."], 404);
        }
        $errorDelete = false;
        foreach ($categories as $category) {
            if (!$this->categoryIRepository->delete($category['id'])) {
                $errorDelete = true;
            }
        }

        if ($errorDelete) return response()->json( ["message" => "Error"], 400);

        return response()->json( ["message" => "success"], 200);
    }
}
