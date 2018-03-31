<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employee;
use App\Company;

class EmployeeDatabaseTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Insert and select employee
     *
     * @return void
     */
    public function testDatabaseEmployeeInserted()
    {
        $insertedCompany = factory(Company::class)->create();

        $insertedEmployee = factory(Employee::class)->create(['company_id' => $insertedCompany->id]);

        $selectedEmployee = Employee::find($insertedEmployee->id);

        $this->assertEquals($insertedEmployee->first_name, $selectedEmployee->first_name);
        $this->assertEquals($insertedEmployee->last_name, $selectedEmployee->last_name);
        $this->assertEquals($insertedEmployee->company_id, $selectedEmployee->company_id);
        $this->assertEquals($insertedEmployee->email, $selectedEmployee->email);
    }

    /**
     * Update and select employee 
     *
     * @return void
     */
    public function testDatabaseEmployeeUpdated()
    {
        $insertedCompany = factory(Company::class)->create();
        $insertedEmployee = factory(Employee::class)->create(['company_id' => $insertedCompany->id]);

        $companyToUpdate = factory(Company::class)->create();
        $employeeToUpdate = factory(Employee::class)->make(['company_id' => $companyToUpdate->id]);

        $insertedEmployee->update([
            'first_name' => $employeeToUpdate->first_name,
            'last_name' => $employeeToUpdate->last_name,
            'email' => $employeeToUpdate->email,
            'company_id' => $employeeToUpdate->company_id,
            'phone' => $employeeToUpdate->phone,
            'phone_country' => $employeeToUpdate->phone_country]);
        
        $updatedEmployee = Employee::find($insertedEmployee->id);

        $this->assertEquals($updatedEmployee->first_name, $employeeToUpdate->first_name);
        $this->assertEquals($updatedEmployee->last_name, $employeeToUpdate->last_name);
        $this->assertEquals($updatedEmployee->email, $employeeToUpdate->email);
        $this->assertEquals($updatedEmployee->company_id, $employeeToUpdate->company_id);
        $this->assertEquals($updatedEmployee->phone, $employeeToUpdate->phone);
        $this->assertEquals($updatedEmployee->phone_country, $employeeToUpdate->phone_country);
    }

    /**
     * Delete employee
     *
     * @return void
     */
    public function testDatabaseEmployeeDeleted()
    {
        $insertedCompany = factory(Company::class)->create();
        $insertedEmployee = factory(Employee::class)->create(['company_id' => $insertedCompany->id]);

        $deleted = $insertedEmployee->destroy($insertedEmployee->id);
        $notFound = Employee::find($insertedEmployee->id);
        
        $this->assertEquals($deleted, true);
        $this->assertEquals($notFound, null);
    }
}
