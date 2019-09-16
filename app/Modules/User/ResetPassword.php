<?php

namespace App\Modules\EducationScore\User;


use App\Models\PasswordReset;
use App\Support\Repository;

class ResetPassword
{


    /**
     * @var User $user
     */
    private $user;


    /**
     * @var Repository $globalRepository
     */
    private $globalRepository;


    /**
     * @var PasswordReset $passwordReset
     */
    private $passwordReset;


    /**
     * ResetPassword constructor.
     */
    public function __construct()
    {

        $this->user = new User();
        $this->globalRepository = new Repository();
        $this->passwordReset = new PasswordReset;
    }


    /**
     * check if mail exists
     * if exist, send reset mail
     *
     * @param array $data
     * @return array|null
     */
    public function forgetPassword(array $data)
    {

        $user = $this->globalRepository->findSingleWhere($this->user, [
            ['email' => $data['email']]
        ]);

        if (!$user) {

            return return_msg(false, 'user not found', []);
        }

        $email = $data['email'];
        $token = str_random() . '_' . uniqid();
        $password_reset = $this->globalRepository->create($this->passwordReset, compact('email', 'token'));

        // send reset link
        //code....


        return return_msg(true, 'reset link sent', compact('password_reset'));
    }


    /**
     * verify reset token send with the reset link...
     *
     * @param array $data
     * @return array|null
     */
    public function verifyToken(array $data)
    {

        $email = $data['email'];
        $token = $data['token'];
        $password_reset = $this->globalRepository
                                ->findSingleWhere(
                                    $this->passwordReset,
                                    compact('email', 'token')
                                );

        return return_msg(boolval($password_reset), '', compact('password_reset'));
    }


    /**
     * reset password with new one...
     *
     * @param array $data
     * @return array|null
     */
    public function resetPassword(array $data)
    {

        $email = $data['email'];
        $user = $this->globalRepository->findSingleWhere($this->user, compact('email'));

        $password = bcrypt($data['password']);

        $this->globalRepository->update($user, compact('password'));

        auth()->login($user);

        return return_msg(true, '', compact('user'));
    }
}