<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ["Donación", "Intercambio", "En Venta"];

        foreach ($categories as $category) {
            Category::updateOrCreate(["name" => $category]);
        }



        // *************  Voyager Model Fields  *****************
        $slug = "categories";
        $icon = 'voyager-categories';

        $dataType = $this->dataType('slug', $slug);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => $slug,
                'display_name_singular' => 'Categoría',
                'display_name_plural'   => 'Categorías',
                'icon'                  => $icon,
                'model_name'            => 'App\\Models\\Category',
                'policy_name'           => '',
                'controller'            => 'App\\Http\\Controllers\\CategoryController',
                'generate_permissions'  => 1,
                'description'           => 'Categorías',
            ])->save();
        }

        $model = DataType::where('slug', $slug)->firstOrFail();
        $column_index = 0;

        $dataRow = $this->dataRow($model, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => $column_index++,
            ])->save();
        }

        $dataRow = $this->dataRow($model, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Nombre Categoría',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $column_index++,
            ])->save();
        }

        // ---------------------------------------

        // Generate Menú
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menu_position = MenuItem::count() + 10;
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Categorías',
            'url'     => '',
            'route'   => "voyager.$slug.index",
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => $icon,
                'color'      => null,
                'parent_id'  => null,
                'order'      => $menu_position,
            ])->save();
        }
        // --------------------------------

        // Generate Permissions for "Model"
        Permission::generateFor($slug);
        // --------------------


        // Set Permissions
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }

    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
