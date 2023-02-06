<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lead;
use App\Models\Course;
use App\Models\Curriculam;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $defaultPermissions = ['lead-management', 'create-admin', 'user-management'];
        foreach($defaultPermissions as $permission){
            Permission::create([
                'name'=>$permission
            ]);
        }
        $this->create_user_with_role('Super Admin', 'Super Admin', 'super-admin@lms.test');
        $this->create_user_with_role('Communication', 'Communication Team', 'communication@lms.test');
        $teacher = $this->create_user_with_role('Teacher', 'Teacher', 'teacher@lms.test');
        $this->create_user_with_role('Leads', 'Leads', 'leads@lms.test');

        Lead::factory()->count(100)->create();
        Course::create([
            'name' =>'Laravel',
            'description' =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet fugiat quas aliquid numquam a, blanditiis optio exercitationem fuga facere ullam recusandae.',
            'image' =>'https://res.cloudinary.com/practicaldev/image/fetch/s--nWYze10a--/c_imagga_scale,f_auto,fl_progressive,h_420,q_auto,w_1000/https://dev-to-uploads.s3.amazonaws.com/i/qtwqedl51vqx5zkxa65d.png',
            'user_id' => $teacher->id,
            'price' => 500,
        ]);
        Curriculam::factory()->count(10)->create();
    }

    private function create_user_with_role($type, $name, $email){
        $role = Role::create([
            'name' => $type
        ]);
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('password'),
        ]);
        if($type == 'Super Admin'){
            $role->givePermissionTo(Permission::all());

            // $permission->assignRole($role);
        }elseif($type == 'Leads'){
            $role->givePermissionTo('lead-management');
        }
        $user->assignRole($type);
        return $user;
    }
}
