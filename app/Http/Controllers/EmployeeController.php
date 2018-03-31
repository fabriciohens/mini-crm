<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Http\requests\EmployeeRequest;
use App\Employee;
use App\Company;

use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id')->get();
        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id')->toArray();;
        return view('employees.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();

        try {
            if ($data['phone'] == null) $data['phone_country'] = null;
            
            $employee = Employee::create($data);
        }
        catch (QueryException $e)
        {
            Session::flash('message', __('messages.error_save'));
            return redirect('/employees');
        }
        catch (Exception $e)
        {
            Session::flash('message', __('messages.error_save'));
            return redirect('/employees');
        }

        Session::flash('message', __('messages.added_successfully', ['name' => $employee->first_name . ' ' . $employee->last_name ]));
        return redirect('/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $companies = Company::pluck('name', 'id')->toArray();;
        return view('employees.show', ['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::pluck('name', 'id')->toArray();;
        return view('employees.update', ['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        
        $data = $request->all();
        $employee->update($data);

        Session::flash('message', __('messages.updated_successfully', ['name' => $employee->first_name . ' ' . $employee->last_name ]));
        return redirect('/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        
        try {
            $employee->destroy($id);
        }
        catch (QueryException $e) {
            Session::flash('message', __('messages.error_delete'));
            return redirect('/companies');
        }
        catch (Exception $e) {
            Session::flash('message', __('messages.error_delete'));
            return redirect('/companies');
        }

        Session::flash('message', __('messages.deleted_successfully', ['name' => $employee->first_name . ' ' . $employee->last_name ]));
        return redirect('/employees');
    }
}
