<?php

namespace Hlacos\LaraMvcms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Hlacos\LaraMvcms\Models\AdminUser;
use Hlacos\LaraMvcms\Models\Role;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lara-mvcms:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an active user with administration roles.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        do {
            if (!isset($validator) || $validator->errors()->has("username")) {
                if (isset($validator) && $validator->errors()->has("username")) {
                    $this->error($validator->errors()->first("username"));
                }
                $data["username"] = $this->ask("User's username: ");
            }

            if (!isset($validator) || $validator->errors()->has("firstname")) {
                if (isset($validator) && $validator->errors()->has("firstname")) {
                    $this->error($validator->errors()->first("firstname"));
                }
                $data["firstname"] = $this->ask("User's firstname: ");
            }

            if (!isset($validator) || $validator->errors()->has("lastname")) {
                if (isset($validator) && $validator->errors()->has("lastname")) {
                    $this->error($validator->errors()->first("lastname"));
                }
                $data["lastname"] = $this->ask("User's lastname: ");
            }

            if (!isset($validator) || $validator->errors()->has("email")) {
                if (isset($validator) && $validator->errors()->has("email")) {
                    $this->error($validator->errors()->first("email"));
                }
                $data["email"] = $this->ask("User's email: ");
                $data["email_confirmation"] = $this->ask("Email again: ");
            }

            if (!isset($validator) || $validator->errors()->has("password")) {
                if (isset($validator) && $validator->errors()->has("password")) {
                    $this->error($validator->errors()->first("password"));
                }
                $data["password"] = $this->secret("User's password: ");
                $data["password_confirmation"] = $this->secret("Password again: ");
            }

            $validator = new Validator;

            $validator = Validator::make($data, [
                'username' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|unique:admin_users,email|confirmed',
                'password' => 'required|confirmed'
            ]);
        } while ($validator->fails());

        $user = new AdminUser;
        $user->username = $data["username"];
        $user->firstname = $data["firstname"];
        $user->lastname = $data["lastname"];
        $user->email = $data["email"];
        $user->is_active = true;
        $user->password = bcrypt($data["password"]);
        $user->save();

        $user->addRoleByName('administrator');
    }
}
