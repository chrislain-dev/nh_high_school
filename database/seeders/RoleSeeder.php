<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des rôles
        $superAdmin = Role::create(['name' => 'Super-Admin']);
        $admin      = Role::create(['name' => 'Admin']);
        $student    = Role::create(['name' => 'Student']);
        $teacher    = Role::create(['name' => 'Teacher']);
        $tutor      = Role::create(['name' => 'Tutor']);

        // Création des permissions générales
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view reports']);

        // Permissions spécifiques aux Tutor
        Permission::create(['name' => 'view children info']);
        Permission::create(['name' => 'view children grades']);

        // Permissions spécifiques aux Teacher
        Permission::create(['name' => 'view assigned classes']);
        Permission::create(['name' => 'add grades']);
        Permission::create(['name' => 'give warnings']);

        // Permissions spécifiques aux Student
        Permission::create(['name' => 'view class info']);
        Permission::create(['name' => 'view own grades']);
        Permission::create(['name' => 'view own info']);

        // Permission réservée au Super-Admin (action irréversible)
        Permission::create(['name' => 'permanently delete']);

        // Attribution des permissions aux rôles

        // Super-Admin : toutes les permissions
        $superAdmin->syncPermissions(Permission::all());

        // Admin : tout sauf la permission de suppression définitive
        $adminPermissions = Permission::where('name', '!=', 'permanently delete')->get();
        $admin->syncPermissions($adminPermissions);

        // Teacher : peut voir les classes qui lui sont attribuées, ajouter des notes, donner des blâmes et consulter les rapports
        $teacher->syncPermissions([
            'view assigned classes',
            'add grades',
            'give warnings',
            'view reports'
        ]);

        // Tutor : peut voir les infos de ses enfants, les notes et consulter les rapports
        $tutor->syncPermissions([
            'view children info',
            'view children grades',
            'view reports'
        ]);

        // Student : peut voir les infos de sa classe, ses notes et ses informations personnelles
        $student->syncPermissions([
            'view class info',
            'view own grades',
            'view own info',
            'view reports'
        ]);
    }
}
