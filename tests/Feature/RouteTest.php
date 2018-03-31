<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class RouteTest extends TestCase
{
    use WithoutMiddleware;

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
     * Route '/'
     *
     * @return void
     */
    public function testRouteSlash()
    {
        $response = $this->get('/');
        $response->assertResponseStatus(200);
    }

    /**
     * Route '/home'
     *
     * @return void
     */
    public function testRouteHome()
    {
        $response =  $this->actingAs($this->user)
            ->get('/home');
        
        $response->assertResponseStatus(200);
    }

    /**
     * Route '/companies'
     *
     * @return void
     */
    public function testRouteCompanies()
    {
        $response =  $this->actingAs($this->user)
            ->get('/companies');
        
        $response->assertResponseStatus(200);
    }
    
    /**
     * Route '/employees'
     *
     * @return void
     */
    public function testRouteEmployees()
    {
        $response =  $this->actingAs($this->user)
            ->get('/employees');
        
        $response->assertResponseStatus(200);
    }
}
