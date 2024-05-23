<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\DepartmentController;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Response;


class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_a_listing_of_departments()
    {
        $controller = new DepartmentController();
        $request = Request::create('/departments', 'GET');
        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('departments', $response->getData());
    }

    /** @test */
    public function it_shows_the_form_for_creating_a_new_department()
    {
        $controller = new DepartmentController();
        $response = $controller->create();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('department', $response->getData());
        $this->assertArrayHasKey('users', $response->getData());
    }

    /** @test */
    public function it_stores_a_new_department()
    {
        // Preparación
        $user = User::factory()->create();
        Auth::login($user);

        $request = new \App\Http\Requests\DepartmentRequest([
            'name' => 'Test Department',
            'chief_manager' => $user->id
        ]);

        // Ejecución
        $controller = new DepartmentController();
        $response = $controller->store($request);

        // Verificación
        $this->assertDatabaseHas('departments', [
            'name' => 'Test Department',
            'chief_manager' => $user->id,
            'created_by' => $user->id,
            'modified_by' => $user->id
        ]);

        $this->assertEquals(route('departments.index'), $response->getTargetUrl());
        $this->assertTrue(session()->has('success'));
    }

}
