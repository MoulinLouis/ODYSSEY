<?php

namespace App;

use App\Core\Form;
use App\Core\View;
use App\Models\User;
use App\Models\Role as ModelRole;
use App\Core\Helpers;
use App\Core\Database;

class Role {
    public function defaultAction() {
        $role = new ModelRole;
        $allRoles = $role->getAllRoles();

        $view = new View("Role/roles", "back");
        $view->assign("allRoles", $allRoles);

        if (!empty($_POST)) {
            if (!empty($_POST['deleteRole'])) {
                $role->delete($_POST['id_role']);
            }
        }
    }
    public function addRoleAction() {
        $role = new ModelRole;

        if(!empty($_POST['values']) && !empty($_POST['name'])) {
            //var_dump($_POST);
            $role->setName($_POST['name']);
            $role->setValue(json_encode($_POST['values']));
            $role->save();
            $_SESSION['alert']['success'][] = "Le rôle a bien été ajouté !";
            header('location: /roles');
            session_write_close();
        }

        $view = new View("Role/add_role", "back");
        $view->assign("rolesList", $role->rolesList());
        $view->assign("roleClass", $role);

    }

    public function editRoleAction() {
        $role = new ModelRole;
        $actualRole = $_GET['role'];
        $db = new Database("Role");
        $result = $db->query(
            ["name", "value"],
            ["id" => $actualRole]
        );
        if(!empty($_POST['values']) && !empty($_POST['name'])) {
            //var_dump($_POST);
            $role->setName($_POST['name']);
            $role->setValue(json_encode($_POST['values']));
            $role->save();
        }

        $view = new View("Role/add_role", "back");
        $view->assign("rolesList", $role->rolesList());
        $view->assign("roleClass", $role);
        $view->assign("roleResult", $result[0]);

    }
}