<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Role;
use App\User;
use Kodeine\Acl\Models\Eloquent\Permission;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rules
        $roleAdmin = Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'description' => 'Administrador geral do sistema'
            ]);
        
        $roleExecutive = Role::create([
            'name' => 'Executive',
            'slug' => 'executive',
            'description' => 'Usuario da categoria "Executive" do sistema'
        ]);

        $roleManager = Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Usuario da categoria "Manager" do sistema'
        ]);
         
        $roleOperational = Role::create([
            'name' => 'Operational',
            'slug' => 'operational',
            'description' => 'Usuario da categoria "Operational" do sistema'
        ]);
        
        $roleStaff = Role::create([
            'name' => 'Staff',
            'slug' => 'staff',
            'description' => 'Usuario da categoria "Staff" do sistema'
        ]);
         

        //Vehicle
        //Permissions
        $permVehicleStaff = Permission::create([
            'name'        => 'vehicle',
            'slug'        => [
                'create' => false,
                'view'   => false,
                'update' => false,
                'delete' => false
            ],
            'description' => 'Administra permissoes do vehicle para o nivel staff de usuario'
        ]);
        
        $permVehicleOperational = Permission::create([
            'name'        => 'vehicle.operational',
            'slug'        => [],
            'inherit_id' => $permVehicleStaff->getKey(),
            'description' => 'Administra permissoes do vehicle para o nivel operational de usuario'
        ]);
        
        $permVehicleManager = Permission::create([
            'name'        => 'vehicle.manager',
            'slug'        => [],
            'inherit_id' => $permVehicleOperational->getKey(),
            'description' => 'Administra permissoes do vehicle para o nivel manager de usuario'
        ]);
        
        $permVehicleExecutive = Permission::create([
            'name'        => 'vehicle.executive',
            'slug'        => [],
            'inherit_id' => $permVehicleManager->getKey(),
            'description' => 'Administra permissoes do vehicle para o nivel executive de usuario'
        ]);
        
        $permVehicleAdmin = Permission::create([
            'name'        => 'vehicle.admin',
            'slug'        => [
                'create' => true,
                'view'   => true,
                'update' => true,
                'delete' => true
            ],
            'inherit_id' => $permVehicleExecutive->getKey(),
            'description' => 'Administra permissoes do vehicle para o nivel admin de usuario'
        ]);
        
        
        //Assign permissions to rules
        $roleStaff->assignPermission($permVehicleStaff);
        $roleOperational->assignPermission($permVehicleOperational);
        $roleManager->assignPermission($permVehicleManager);
        $roleExecutive->assignPermission($permVehicleExecutive);
        $roleAdmin->assignPermission($permVehicleAdmin);
        

        //Company
        //Permissions
        $permCompanyStaff = Permission::create([
            'name'        => 'company',
            'slug'        => [
                'create' => false,
                'view'   => false,
                'update' => false,
                'delete' => false
            ],
            'description' => 'Administra permissoes do company para o nivel staff de usuario'
        ]);
        
        $permCompanyOperational = Permission::create([
            'name'        => 'company.operational',
            'slug'        => [],
            'inherit_id' => $permCompanyStaff->getKey(),
            'description' => 'Administra permissoes do company para o nivel operational de usuario'
        ]);
        
        $permCompanyManager = Permission::create([
            'name'        => 'company.manager',
            'slug'        => [],
            'inherit_id' => $permCompanyOperational->getKey(),
            'description' => 'Administra permissoes do company para o nivel manager de usuario'
        ]);
        
        $permCompanyExecutive = Permission::create([
            'name'        => 'company.executive',
            'slug'        => [],
            'inherit_id' => $permCompanyManager->getKey(),
            'description' => 'Administra permissoes do company para o nivel executive de usuario'
        ]);
        
        $permCompanyAdmin = Permission::create([
            'name'        => 'company.admin',
            'slug'        => [
                'create' => true,
                'view'   => true,
                'update' => true,
                'delete' => true
            ],
            'inherit_id' => $permCompanyExecutive->getKey(),
            'description' => 'Administra permissoes do company para o nivel admin de usuario'
        ]);
        
        
        //Assign permissions to rules
        $roleStaff->assignPermission($permCompanyStaff);
        $roleOperational->assignPermission($permCompanyOperational);
        $roleManager->assignPermission($permCompanyManager);
        $roleExecutive->assignPermission($permCompanyExecutive);
        $roleAdmin->assignPermission($permCompanyAdmin);
        
        
        //User
        //Permissions
        $permUserStaff = Permission::create([
            'name'        => 'user',
            'slug'        => [
                'create' => false,
                'view'   => false,
                'update' => false,
                'delete' => false
            ],
            'description' => 'Administra permissoes do user para o nivel staff de usuario'
        ]);
        
        $permUserOperational = Permission::create([
            'name'        => 'user.operational',
            'slug'        => [],
            'inherit_id' => $permUserStaff->getKey(),
            'description' => 'Administra permissoes do user para o nivel operational de usuario'
        ]);
        
        $permUserManager = Permission::create([
            'name'        => 'user.manager',
            'slug'        => [],
            'inherit_id' => $permUserOperational->getKey(),
            'description' => 'Administra permissoes do user para o nivel manager de usuario'
        ]);
        
        $permUserExecutive = Permission::create([
            'name'        => 'user.executive',
            'slug'        => [],
            'inherit_id' => $permUserManager->getKey(),
            'description' => 'Administra permissoes do user para o nivel executive de usuario'
        ]);
        
        $permUserAdmin = Permission::create([
            'name'        => 'user.admin',
            'slug'        => [
                'create' => true,
                'view'   => true,
                'update' => true,
                'delete' => true
            ],
            'inherit_id' => $permUserExecutive->getKey(),
            'description' => 'Administra permissoes do user para o nivel admin de usuario'
        ]);
        
        
        //Assign permissions to rules
        $roleStaff->assignPermission($permUserStaff);
        $roleOperational->assignPermission($permUserOperational);
        $roleManager->assignPermission($permUserManager);
        $roleExecutive->assignPermission($permUserExecutive);
        $roleAdmin->assignPermission($permUserAdmin);
        
        
        //Assign role to user
    	$user = User::first();
    	if ($user) {
    	    $user->assignRole($roleAdmin);
    	}
    }
}
