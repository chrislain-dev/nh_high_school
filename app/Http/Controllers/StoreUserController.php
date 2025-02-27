<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\NewTutorAddedMail;
use App\Mail\NewStudentAddedMail;
use App\Mail\NewTeacherAddedMail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UserAddedNotification;
use Illuminate\Support\Facades\Notification;

class StoreUserController extends Controller
{
    /**
     * Crée un nouvel utilisateur en fonction du rôle spécifié.
     *
     * @param string $first_name Prénom de l'utilisateur
     * @param string $last_name Nom de l'utilisateur
     * @param string $email Email de l'utilisateur
     * @param string $role Rôle à assigner (Student, Teacher, Tutor). Par défaut, "Student"
     *
     * @return bool
     */
    public static function store(string $first_name, string $last_name, string $email, string $role = 'Student'): bool
    {
        $name = $first_name . ' ' . $last_name;
        $password = 'NH' . Str::upper(Str::random(4)) . rand(10, 99);
        $hashedPassword = Hash::make($password);

        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $hashedPassword,
        ]);

        // Attribution du rôle spécifié
        $user->assignRole($role);

        // Envoi de l'email selon le rôle de l'utilisateur
        switch ($role) {
            case 'Teacher':
                Mail::to($user->email)->send(new NewTeacherAddedMail($user, $password));
                break;
            case 'Tutor':
                Mail::to($user->email)->send(new NewTutorAddedMail($user, $password));
                break;
            default:
                // Par défaut, envoie l'email pour un Student
                Mail::to($user->email)->send(new NewStudentAddedMail($user, $password));
                break;
        }

        // Notification aux administrateurs (Super-Admin et Admin)
        $admins = User::role(['Super-Admin', 'Admin'])->get();
        Notification::send($admins, new UserAddedNotification($user));

        return true;
    }
}
