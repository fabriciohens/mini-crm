<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\User;

class CompanyTest extends TestCase
{   
    use RefreshDatabase;
    
    private $user = null;

    /**
     * Makes fake user for each test
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->make();
    }

    /**
     * Submitting a new record successfully
     *
     * @return void
     */
    public function testFormSubmitSuccess()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->attach('tests/feature/images/100x100.png', 'logo')
            ->type('Company Test', 'name')
            ->type('email@test.com', 'email')
            ->type('http://www.companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies')
            ->see('\'Company Test\' added successfully!');
    }

    /**
     * Submitting a new record with invalid email
     *
     * @return void
     */
    public function testFormSubmitInvalidEmail()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->attach('tests/feature/images/101x101.png', 'logo')
            ->type('Company Test', 'name')
            ->type('email', 'email')
            ->type('http://www.companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The email must be a valid email address.');
    }

    /**
     * Submitting a new record with invalid website
     *
     * @return void
     */
    public function testFormSubmitInvalidWebsite()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->type('Company Test', 'name')
            ->type('companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The website format is invalid.');
    }

    /**
     * Submitting a new record without name value
     *
     * @return void
     */
    public function testFormSubmitWithoutName()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->type('email@test.com', 'email')
            ->type('http://www.companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The Name field is required.');
    }

    /**
     * Submitting a new record with invalid logo dimensions for X and Y axis
     *
     * @return void
     */
    public function testFormSubmitLogoInvalidDimensionsForXandY()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->attach('tests/feature/images/99x99.png', 'logo')
            ->type('Company Test', 'name')
            ->type('email@test.com', 'email')
            ->type('http://www.companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The logo has invalid image dimensions. Minimun: 100x100');
    }

    /**
     * Submitting a new record with invalid logo dimensions for X axis
     *
     * @return void
     */
    public function testFormSubmitLogoInvalidDimensionsForX()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->attach('tests/feature/images/99x100.png', 'logo')
            ->type('Company Test', 'name')
            ->type('email@test.com', 'email')
            ->type('http://www.companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The logo has invalid image dimensions. Minimun: 100x100');
    }

    /**
     * Submitting a new record with invalid logo dimensions for Y axis
     *
     * @return void
     */
    public function testFormSubmitLogoInvalidDimensionsForY()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->attach('tests/feature/images/100x99.png', 'logo')
            ->type('Company Test', 'name')
            ->type('email@test.com', 'email')
            ->type('http://www.companysite.com', 'website')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The logo has invalid image dimensions. Minimun: 100x100');
    }

    /**
     * Submitting the form without any value
     *
     * @return void
     */
    public function testFormSubmitWithoutAnyValue()
    {
        $this->actingAs($this->user)
            ->visit('/companies/create')
            ->see('Create a new Company')
            ->dontSee('Create a new Employee')
            ->press('Create')
            ->seePageIs('/companies/create')
            ->see('The Name field is required.');
    }

    protected function getUser() {
        return factory(User::class)->create();
    }
}
