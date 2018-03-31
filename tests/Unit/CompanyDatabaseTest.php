<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Company;

class CompanyDatabaseTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Insert and select company
     *
     * @return void
     */
    public function testDatabaseCompanyInserted()
    {
        $insertedCompany = factory(Company::class)->create();

        $selectedCompany = Company::find($insertedCompany->id);

        $this->assertEquals($insertedCompany->name, $selectedCompany->name);
        $this->assertEquals($insertedCompany->email, $selectedCompany->email);
        $this->assertEquals($insertedCompany->website, $selectedCompany->website);
    }

    /**
     * Update and select company
     *
     * @return void
     */
    public function testDatabaseCompanyUpdated()
    {
        $insertedCompany = factory(Company::class)->create();
        $companyToUpdate = factory(Company::class)->make();
        
        $insertedCompany->update([
            'name' => $companyToUpdate->name,
            'email' => $companyToUpdate->email,
            'website' => $companyToUpdate->website]);
        
        $updatedCompany = Company::find($insertedCompany->id);

        $this->assertEquals($updatedCompany->name, $companyToUpdate->name);
        $this->assertEquals($updatedCompany->email, $companyToUpdate->email);
        $this->assertEquals($updatedCompany->website, $companyToUpdate->website);
    }

    /**
     * Delete company
     *
     * @return void
     */
    public function testDatabaseCompanyDeleted()
    {
        $insertedCompany = factory(Company::class)->create();

        $deleted = $insertedCompany->destroy($insertedCompany->id);
        $notFound = Company::find($insertedCompany->id);
        
        $this->assertEquals($deleted, true);
        $this->assertEquals($notFound, null);
    }
}
