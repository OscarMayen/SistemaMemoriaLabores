<?php

use Illuminate\Database\Seeder;
use App\User;
use App\RolesPermission\Model\Role;
use App\RolesPermission\Model\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RolesPermissionInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // truncate tables para Postgres
        DB::statement("ALTER TABLE role_user DISABLE TRIGGER ALL");
        DB::statement("ALTER TABLE permission_role DISABLE TRIGGER ALL");
        Permission::truncate();
        Role::truncate();
        DB::statement("ALTER TABLE role_user ENABLE TRIGGER ALL");
        DB::statement("ALTER TABLE permission_role ENABLE  TRIGGER ALL");

        // truncate tables para MySql
        /*DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB::statement("SET foreign_key_checks=1");*/
        //user admin

        //Si existe un usuario con el email indicado lo eliminar
        $useradmin = User::where('email', 'admin@admin.com')->first();
        if($useradmin){
            $useradmin->delete();
        }
        // Creacion de un super usuario o administrador de todo el sistema
        $useradmin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);

        // Rol admin
        $roladmin = Role ::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrador',
            'full-access' => 'si'
        ]);

        //Se crea la relacion entre dos tablas en role_user
        $useradmin->roles()->sync([ $roladmin->id ]);

        //permission
        $permission_all = [];

        // permission role
        $permission = Permission ::create([
            'name' => 'Listar roles',
            'slug' => 'role.index',
            'description' => 'Un usuario puede listar roles'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Ver rol',
            'slug' => 'role.show',
            'description' => 'Un usuario puede ver detalles del rol'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Crear rol',
            'slug' => 'role.create',
            'description' => 'Un usuario puede crear rol'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Editar rol',
            'slug' => 'role.edit',
            'description' => 'Un usuario puede editar rol'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Eliminar rol',
            'slug' => 'role.destroy',
            'description' => 'Un usuario puede eliminar rol'
        ]);

        $permission_all[] = $permission->id;

        // permission user
        $permission = Permission ::create([
            'name' => 'Listar usuarios',
            'slug' => 'user.index',
            'description' => 'Un usuario puede listar usuarios'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Ver usuario',
            'slug' => 'user.show',
            'description' => 'Un usuario puede ver detalles de usuarios'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Editar usuario',
            'slug' => 'user.edit',
            'description' => 'Un usuario puede editar usuario'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Eliminar usuario',
            'slug' => 'user.destroy',
            'description' => 'Un usuario puede eliminar usuario'
        ]);

        $permission_all[] = $permission->id;

        // Nuevo
        $permission = Permission ::create([
            'name' => 'Ver solo los datos propios del usuario',
            'slug' => 'userown.show',
            'description' => 'Un usuario puede ver solo sus datos'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission ::create([
            'name' => 'Editar solo los datos propios del usuario',
            'slug' => 'userown.edit',
            'description' => 'Un usuario puede editar solo sus datos'
        ]);

        $permission_all[] = $permission->id;

        //Se crea la relacion entre dos tablas en permission_role
        //$roladmin->permissions()->sync( $permission_all );

    }
}
