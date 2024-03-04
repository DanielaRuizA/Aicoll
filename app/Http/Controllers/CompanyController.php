<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $s = $request->input('s');

            $companies = Company::when($s, function ($query) use ($s) {
                $query->where('nit', 'LIKE', '%' . $s . '%')
                    ->orWhere('name', 'LIKE', '%' . $s . '%');
            })->get();

            return view('companies.index', compact('companies'));
        } catch (\Exception $e) {
            Log::error('Error in CompaniesController@index: ' . $e->getMessage());

            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        Log::info('Acceso a la vista de agregar una empresa.', ['company_id' => $company->id]);

        return view('companies.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request, Company $company)
    {
        try {
            $company->create($request->validated());

            Log::info('Empresa creada exitosamente.', ['company_id' => $company->id]);

            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            Log::error('Error al crear empresa.', ['company_id' => $company->id, 'error' => $e->getMessage()]);

            return back()->with('error', 'Error al crear empresa.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        Log::info('Acceso a la vista de edición de la empresa.', ['company_id' => $company->id]);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        try {
            $company->update($request->validated());

            Log::info('La empresa ha sido actualizada exitosamente.', ['company_id' => $company->id]);

            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            Log::error('Error al actualizar la empresa.', ['company_id' => $company->id, 'error' => $e->getMessage()]);

            return back()->with('error', 'Error al actualizar la empresa.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();

            Log::info(' Empresa eliminada exitosamente.', ['company_id' => $company->id]);

            return back();
        } catch (\Exception $e) {
            Log::error('Error al eliminar la empresa.', ['company_id' => $company->id, 'error' => $e->getMessage()]);

            return back()->with('error', 'Error al eliminar la empresa.');
        }
    }

    //cambiar estatus de la compañía
    public function changeCompanyStatus(Request $request)
    {
        $company = Company::find($request->company_id);

        $company->status = $request->status;

        $company->save();
    }
}
