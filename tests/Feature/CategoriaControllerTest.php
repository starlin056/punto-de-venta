<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Caracteristica;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $permisos = [
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'eliminar-categoria'
        ];

        foreach ($permisos as $permiso) {
            Permission::findOrCreate($permiso, 'web');
        }

        $this->user = User::factory()->create();
        $this->user->givePermissionTo($permisos);
        $this->actingAs($this->user);
    }

    public function test_list_all_categories()
    {
        Categoria::factory()->count(5)->create();

        $response = $this->get(route('categorias.index'));

        $this->assertDatabaseCount('categorias', 5);
        $response->assertStatus(200);
    }

    public function test_show_the_create_view()
    {
        $response = $this->get(route('categorias.create'));

        $response->assertStatus(200);
        $response->assertViewIs('categoria.create');
    }

    public function test_store_categoria_successfully()
    {
        $data = [
            'nombre' => 'Categoria Ejemplo',
            'descripcion' => 'Esta es una descripcion de ejemplo.',
        ];

        $response = $this->post(route('categorias.store'), $data);

        $this->assertDatabaseHas('caracteristicas', $data);

        $this->assertDatabaseHas('categorias', [
            'caracteristica_id' => Caracteristica::where('nombre', 'Categoria Ejemplo')->value('id'),
        ]);

        $response->assertRedirect(route('categorias.index'))
                 ->assertSessionHas('success', 'Categoría registrada');
    }

    public function test_show_the_edit_view()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->get(route('categorias.edit', $categoria));

        $response->assertStatus(200);
        $response->assertViewIs('categoria.edit');
        $response->assertViewHas('categoria', $categoria);
    }

    public function test_update_category_successfully()
    {
        $categoria = Categoria::factory()->create();

        $data = [
            'nombre' => 'Nuevo Nombre',
            'descripcion' => 'Nueva Descripcion',
        ];

        $response = $this->patch(route('categorias.update', $categoria), $data);

        $response->assertRedirect(route('categorias.index'))
                 ->assertSessionHas('success', 'Categoría editada');

        $this->assertDatabaseHas('caracteristicas', $data);
    }

    public function test_toggle_a_category_successfully()
    {
        $caracteristica = Caracteristica::factory()->create(['estado' => 1]);
        $categoria = Categoria::factory()->create(['caracteristica_id' => $caracteristica->id]);

        // Desactivar
        $response = $this->delete(route('categorias.destroy', $categoria->id));

        $this->assertDatabaseHas('caracteristicas', [
            'id' => $caracteristica->id,
            'estado' => 0,
        ]);

        $response->assertRedirect(route('categorias.index'));
        $response->assertSessionHas('success', 'Categoría eliminada');

        // Reactivar
        $response = $this->delete(route('categorias.destroy', $categoria->id));

        $this->assertDatabaseHas('caracteristicas', [
            'id' => $caracteristica->id,
            'estado' => 1,
        ]);

        $response->assertRedirect(route('categorias.index'));
        $response->assertSessionHas('success', 'Categoría restaurada');
    }
}
