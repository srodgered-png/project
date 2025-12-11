<?php
namespace App\Controller;

use App\Service\Request;
use App\Repository\UserRepository;
use App\Model\User;
use App\Form\UserForm;
use App\Mapper\UserMapper;
use PDO;

class AppController extends AbstractController
{

    public function getAll(PDO $pdo, UserRepository $ur): string
    {
        $users = $ur->getUsers($pdo);
        $userMapper = new UserMapper();
        return $userMapper->userListToJson($users);
    }

    public function get(PDO $pdo, Request $request, UserRepository $ur): string
    {
        $contents = $request->get();
        $user = $ur->findUserById($pdo, $contents['id']??0);

        $userMapper = new UserMapper();
        return $userMapper->userToJson($user);
    }

    public function create(PDO $pdo, Request $request, UserRepository $ur): string
    {
        $userForm = new UserForm($request->contents());
        if (!$userForm->validate()) {
            return $userForm->errorsToJson();
        }

        $user = new User();
        $userForm->apply($user);
        $ur->createUser($pdo, $user);

        $userMapper = new UserMapper();
        return $userMapper->userToJson($user);
    }

    public function update(PDO $pdo, Request $request, UserRepository $ur): string
    {
        $userForm = new UserForm($request->contents());
        if (!$userForm->validate()) {
            return $userForm->errorsToJson();
        }

        $user = new User();
        $userForm->apply($user);
        $ur->updateUser($pdo, $user);

        $userMapper = new UserMapper();
        return $userMapper->userToJson($user);
    }

    public function delete(PDO $pdo, Request $request, UserRepository $ur): string
    {
        $contents = $request->contents();

        $user = new User();
        $user->setId($contents['id']??0);

        $ur->deleteUser($pdo, $user);

        return '';
    }
}