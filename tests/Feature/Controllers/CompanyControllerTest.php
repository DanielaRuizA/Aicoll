<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Company;
use App\Models\User;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testAccessCompaniesIndex(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('companies')
            ->assertStatus(200);
    }

    public function testUserCanAccessCreateFormCompany(): void
    {
        $user = User::factory()->create();

        $data = [
            'nit' => 12345678,
            'name' => 'prueba',
            'address' => 'calle 60 # 46',
            'phone' => 12345,
        ];

        $company = Company::factory()->create();

        $this
            ->actingAs($user)
            ->get('companies/create', $data)
            ->assertStatus(200)
            ->assertSee($company->NIT)
            ->assertSee($company->Nombre)
            ->assertSee($company->Dirección)
            ->assertSee($company->Teléfono);
    }

    public function testUserStoreCompany(): void
    {
        $user = User::factory()->create();

        Company::factory()->create();

        $data = [
            'nit' => 12345679,
            'name' => 'prueba1',
            'address' => 'calle 60 # 48',
            'phone' => 12346,
        ];

        $response = $this->actingAs($user)
            ->post(route('companies.store'), $data);

        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseHas('companies', $data);
    }

    public function testAdminCanAccessEditFormCompany(): void
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $this->actingAs($user)
            ->get("companies/$company->id/edit")
            ->assertStatus(200)
            ->assertSee($company->Nombre)
            ->assertSee($company->Dirección)
            ->assertSee($company->Teléfono)
            ->assertSee($company->Empresa);
    }

    public function testUserUpdateCompany(): void
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $data = [
            'name' => 'prueba2',
            'address' => 'avenida 60 # 48',
            'phone' => 92343,
        ];

        $this->actingAs($user)
            ->put("companies/$company->id", $data)
            ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', $data);
    }

    public function testUserDestroyCompany(): void
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $this
            ->actingAs($user)
            ->delete("companies/$company->id")
            ->assertRedirect();

        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
            'nit' => $company->nit,
            'name' => $company->name,
            'address' => $company->address,
            'phone' => $company->phone,
            'status' => $company->status,
        ]);
    }

    public function testUserChangeCompanyStatus(): void
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $response = $this->actingAs($user)
            ->json('get', 'company/status', [
                'company_id' => $company->id,
                'status' => 'Inactive',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'status' => 'Inactive',
        ]);
    }
}
