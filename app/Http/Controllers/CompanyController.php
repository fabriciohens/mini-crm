<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

use App\Http\Requests\CompanyRequest;
use App\Mail\NewCompanyEntered;
use App\Company;

use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id')->get();
        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();

        $company = null;
        try {
            $company = Company::create($data);
        }
        catch (QueryException $e) {
            Session::flash('message', __('messages.error_save'));
            return redirect('/companies');
        }
        catch (Exception $e) {
            Session::flash('message', __('messages.error_save'));
            return redirect('/companies');
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public');
            $company->update(['logo' => $path]);
        }

        Mail::to($request->user())->send(new NewCompanyEntered($company));

        Session::flash('message', __('messages.added_successfully', ['name' => $company->name]));
        return redirect('/companies');
    }

    /**
     * Trim the file path
     */
    private function trimLogoPath($pathToLogo) {
        if ($pathToLogo == '') 
            return '';
        return substr_replace($pathToLogo, 'storage', 0, 6);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        $company->logo = $this->trimLogoPath($company->logo);

        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.update', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        
        $data = $request->all();
        if ($request->hasFile('logo')) {
            if (Storage::disk('local')->exists($company->logo)) {
                Storage::delete($company->logo);
            }
            $path = $request->file('logo')->store('public');
            $data['logo'] = $path;
        }
        
        $company->update($data);
        
        Session::flash('message', __('messages.updated_successfully', ['name' => $company->name]));
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        
        try {
            $company->destroy($id);
        }
        catch (QueryException $e) {
            Session::flash('message', __('messages.error_delete'));
            return redirect('/companies');
        }
        catch (Exception $e) {
            Session::flash('message', __('messages.error_delete'));
            return redirect('/companies');
        }
        
        if (Storage::exists($company->logo)) {
            Storage::delete($company->logo);
        }
        
        Session::flash('message', __('messages.deleted_successfully', ['name' => $company->name]));
        return redirect('/companies');
    }
}
