<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Company;
use App\User;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    private $company = null;
    private $user = null;

    /**
     * Creates fake company and makes fake user for each test
     */
    public function setUp()
    {
        parent::setUp();
        $this->company = factory(Company::class)->create();
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
            ->visit('/employees/create')
            ->see('Create a new Employee')
            ->dontSee('Create a new Company')
            ->type('John', 'first_name')
            ->type('Test', 'last_name')
            ->select($this->company->id, 'company_id')
            ->type('email@test.com', 'email')
            ->select('BR', 'phone_country')
            ->type('11 972827384', 'phone')
            ->press('Create')
            ->seePageIs('/employees')
            ->see('\'John Test\' added successfully!');
    }

    /**
     * Submitting a new record with invalid email
     *
     * @return void
     */
    public function testFormSubmitInvalidEmail()
    {
        $this->actingAs($this->user)
            ->visit('/employees/create')
            ->see('Create a new Employee')
            ->dontSee('Create a new Company')
            ->type('John', 'first_name')
            ->type('Test', 'last_name')
            ->select($this->company->id, 'company_id')
            ->type('email', 'email')
            ->select('BR', 'phone_country')
            ->type('11 972827384', 'phone')
            ->press('Create')
            ->seePageIs('/employees/create')
            ->see('The email must be a valid email address.');
    }

    /**
     * Submitting a new record with invalid phone
     *
     * @return void
     */
    public function testFormSubmitInvalidPhone()
    {
        $this->actingAs($this->user)
            ->visit('/employees/create')
            ->see('Create a new Employee')
            ->dontSee('Create a new Company')
            ->type('John', 'first_name')
            ->type('Test', 'last_name')
            ->select($this->company->id, 'company_id')
            ->type('email@test.com', 'email')
            ->select('BR', 'phone_country')
            ->type('999 99 99 99', 'phone')
            ->press('Create')
            ->seePageIs('/employees/create')
            ->see('The phone field contains an invalid number. Check if the country is matching the specified phone number.');
    }

    /**
     * Submitting a new record without first name value
     *
     * @return void
     */
    public function testFormSubmitWithoutFirstName()
    {
        $this->actingAs($this->user)
            ->visit('/employees/create')
            ->see('Create a new Employee')
            ->dontSee('Create a new Company')
            ->type('Test', 'last_name')
            ->select($this->company->id, 'company_id')
            ->type('email@test.com', 'email')
            ->select('BR', 'phone_country')
            ->type('999 99 99 99', 'phone')
            ->press('Create')
            ->seePageIs('/employees/create')
            ->see('The First Name field is required.');
    }

    /**
     * Submitting a new record without last name value
     *
     * @return void
     */
    public function testFormSubmitWithoutLastName()
    {
        $this->actingAs($this->user)
            ->visit('/employees/create')
            ->see('Create a new Employee')
            ->dontSee('Create a new Company')
            ->type('John', 'first_name')
            ->select($this->company->id, 'company_id')
            ->type('email@test.com', 'email')
            ->select('BR', 'phone_country')
            ->type('999 99 99 99', 'phone')
            ->press('Create')
            ->seePageIs('/employees/create')
            ->see('The Last Name field is required.');
    }

    /**
     * Submitting the form without any value
     *
     * @return void
     */
    public function testFormSubmitWithoutAnyValue()
    {
        $this->actingAs($this->user)
            ->visit('/employees/create')
            ->see('Create a new Employee')
            ->dontSee('Create a new Company')
            ->press('Create')
            ->seePageIs('/employees/create')
            ->see('The First Name field is required.')
            ->see('The Last Name field is required.');
    }
}
