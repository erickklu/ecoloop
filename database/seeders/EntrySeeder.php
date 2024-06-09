<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class EntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // *************  Voyager Model Fields  *****************
        $slug = "entries";
        $icon = 'voyager-file-text';
        $model = 'Entry';

        $dataType = $this->dataType('slug', $slug);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => $slug,
                'display_name_singular' => 'Publicación',
                'display_name_plural'   => 'Publicaciones',
                'icon'                  => $icon,
                'model_name'            => "App\\Models\\$model",
                'policy_name'           => '',
                'controller'            => "App\\Http\\Controllers\\$model" . "Controller",
                'generate_permissions'  => 1,
                'description'           => '',
                'details'               => [
                    'scope' => 'ownEntries'
                ]
            ])->save();
        }

        $modelType = DataType::where('slug', $slug)->firstOrFail();
        $column_index = 0;

        $dataRow = $this->dataRow($modelType, 'id');
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

        $dataRow = $this->dataRow($modelType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Título',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $column_index++,
            ])->save();
        }

        $dataRow = $this->dataRow($modelType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Descripción',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $column_index++,
            ])->save();
        }

        $dataRow = $this->dataRow($modelType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Imágen',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $column_index++,
            ])->save();
        }

        $dataRow = $this->dataRow($modelType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Usuario',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => $column_index++,
            ])->save();
        }

        $dataRow = $this->dataRow($modelType, 'user');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Usuario',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => $column_index++,
                'details'      => [
                    'model'    => 'App\\Models\\User',
                    'type'     => 'belongsTo',
                    'column'   => 'user_id',
                    'key'      => 'id',
                    'table'    => "users",
                    'label'    => 'name'
                ]
            ])->save();
        }

        // ---------------------------------------

        // Generate Menú
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menu_position = MenuItem::count() + 10;
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Publicaciones',
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
