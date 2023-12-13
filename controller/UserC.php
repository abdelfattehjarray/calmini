<?php
include_once("../config.php");
include_once("../model/User.php");




class UserC
{
    //***********************************Function add with sign up system
    function addUser($user)
    {

        $sql = "INSERT INTO user VALUES(NULL,:lastName,:firstName,:email,:passwordd,:dob,:code,:picture,:localisation,:profession)";
        $db = config::getConnexion();
        $result = $db->prepare("SELECT * from `user` where email =:email1 ");
        $result->bindValue(':email1', $user->getEmail());
        $result->execute();
        $row_count = $result->fetchColumn();
        if ($row_count == 0) {
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    'firstName' => $user->getFirstName(),
                    'lastName' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'passwordd' => $user->getPassword(),
                    'dob' => $user->getDob()->format('Y/m/d'),
                    'code' => $user->getCode(),
                    'picture' => $user->getpicture(),
                    'localisation' => $user->getLocalisation(),
                    'profession' => $user->getProfession()
                ]);
            } catch (Exception $e) {
                echo "error=:" . $e->getMessage();
            }
        }
        $error = $row_count > 0;
        if ($error) {
            //echo "nope bro";
            return false;
        }
        return true;
    }

    //***********************************Function add without sign up system
    function addUser1($user)
    {

        $sql = "INSERT INTO user VALUES(NULL,:lastName,:firstName,:email,:passwordd,:dob,:code,:picture,:localisation,:profession)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'passwordd' => $user->getPassword(),
                'dob' => $user->getDob()->format('Y/m/d'),
                'code' => $user->getCode(),
                'picture' => $user->getpicture(),
                'localisation' => $user->getLocalisation(),
                'profession' => $user->getProfession()
            ]);
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    //***********************************Function add Admin
    function addAdmin($user)
    {

        $sql = "INSERT INTO `admin` VALUES(NULL,:lastName,:firstName,:email,:passwordd,:dob,:picture)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'passwordd' => $user->getPassword(),
                'dob' => $user->getDob()->format('Y/m/d'),
                'picture' => $user->getpicture()
            ]);
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    //***********************************Function add in himage
    function addImage($image, $id)
    {

        $sql = "INSERT INTO `himage` VALUES(NULL,:picture,:id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'picture' => $image,
                'id' => $id
            ]);
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    //****************************fonction afficher fromm himage
    function listImage($id)
    {
        $sql = "SELECT * FROM `himage` where idu like $id LIMIT 6";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //****************************fonction afficher
    function listUser()
    {
        $sql = "SELECT * FROM user LIMIT 4";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //****************************fonction afficher user google
    function listUserG()
    {
        $sql = "SELECT * FROM users LIMIT 4";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    //*****************************fonction supprimer
    function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id =:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //*****************************fonction supprimer user Google
    function deleteUserG($id)
    {
        $sql = "DELETE FROM users WHERE id =:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    //***********************************fonction Modifier
    function updateUser($user, $id)
    {
        $sql = "UPDATE user SET lastName=:lastName,firstName=:firstName,email=:email,passwordd=:passwordd,dob=:dob, code =:code, picture =:picture , localisation =:localisation , profession =:profession  where id=:idUser";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idUser' => $id,
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'passwordd' => $user->getPassword(),
                'dob' => $user->getDob()->format('Y/m/d'),
                'code' => $user->getCode(),
                'picture' => $user->getpicture(),
                'localisation' => $user->getLocalisation(),
                'profession' => $user->getProfession()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";;
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }

    //***********************************fonction login
    function login($emailL)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        //$sql1 = "SELECT * FROM `admin` WHERE email = :email and passwordd = :passwordL";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        //$req1 = $db->prepare($sql1);
        $req->bindValue(':email', $emailL);
        //$req->bindValue(':passwordL', $passwordL);
        // $req1->bindValue(':email', $emailL);
        // $req1->bindValue(':passwordL', $passwordL);
        try {
            $req->execute();
            //$req1->execute();
            $row_count = $req->fetchColumn();
            //$row_count1 = $req1->fetchColumn();
            if ($row_count != 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }

    //***********************************fonction remplissage des champs
    function showUser($id)
    {
        $sql = "SELECT * from user where id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    //***********************************fonction rechercher
    function searchUser($data)
    {
        $sql = "SELECT * from user where id like :dataa or  LASTNAME like :dataa or firstname like :dataa";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':dataa', $data);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    //***********************************fonction remplissage des champs POUR ADMIN
    function showAdmin($id)
    {
        $sql = "SELECT * from `admin` where email = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    //***********************************fonction tri
    function sortUser($data)
    {
        $sql = "SELECT * from user ORDER BY `$data` ASC";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            //$query->bindValue(':dataa',$data);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function SearchByAttribute($data)
    {
        $sql = "SELECT * FROM `user` WHERE `ID` LIKE :dataa OR `LASTNAME` LIKE :dataa OR `FIRSTNAME` LIKE :dataa";
        $db = config::getConnexion();
        try {
            $db->bindValue(':dataa', '%' . $data . '%');
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    //****************************fonction extraction de l'annee
    function extractYear()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function MaxId($data)
    {
        $sql = "SELECT * from user where email like :dataa";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':dataa', $data);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //get id admin 
    function adminId($data)
    {
        $sql = "SELECT * from `admin` where email like :dataa";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':dataa', $data);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    //******************************fonctions qui permet de verifier l'email 
    //1-fonction qui permet de savoir si verifier ou pas
    function verifierOuPas($data)
    {
        $sql = "SELECT * from user where CODE like :dataa";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':dataa', $data);
            $query->execute();
            $row_count = $query->fetchColumn();
            if ($row_count != 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //2-fonction qui permet de metre le champs code a vide
    function vider($data)
    {
        $sql = "UPDATE user SET CODE = '' WHERE CODE like :dataa";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':dataa', $data);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //3-fonction qui permet de renvoyer la colone
    function renvoyerColone($email)
    {
        $sql = "SELECT * from user where email like :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            //$query->bindValue(':passwordd',$password);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    //***********************************fonction pour verififer si c'est un admin ou pas
    function verifAdmin($emailL)
    {
        $sql1 = "SELECT * FROM `admin` WHERE email = :email";
        $db = config::getConnexion();
        $req1 = $db->prepare($sql1);
        $req1->bindValue(':email', $emailL);
        //$req1->bindValue(':passwordL', $passwordL);
        try {
            $req1->execute();
            $row_count1 = $req1->fetchColumn();
            if ($row_count1 != 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    //***********************************fonction pour avoir le nom de l'utilisateur
    function recupererNom($id)
    {
        $sql = "SELECT * from user where id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    //***********************************fonction pour avoir le nom de l'admin
    function recupererNomA($id)
    {
        $sql = "SELECT * from `admin` where id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    //***********************************fonction pour verififer si c'est un admin ou pas
    function verifierEmail($emailL)
    {
        $sql1 = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        $req1 = $db->prepare($sql1);
        $req1->bindValue(':email', $emailL);
        try {
            $req1->execute();
            $row_count1 = $req1->fetchColumn();
            if ($row_count1 != 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }

    //***********************************fonction Modifier le code pour recuperer mdp
    function updateCode($code, $email)
    {
        $sql = "UPDATE user SET code=:code where email=:email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':code', $code);
            $query->bindValue(':email', $email);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    //***********************************fonction Modifier le mdp
    function updateMdp($mdp, $code)
    {
        $sql = "UPDATE user SET PASSWORDD=:mdp,code='' where CODE=:code";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':code', $code);
            $query->bindValue(':mdp', $mdp);
            $query->execute();
            return $query;
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    function renvoyerMdpUser($email)
    {
        $sql = "SELECT * from user where email like :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            //$query->bindValue(':passwordd',$password);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function renvoyerMdpAdmin($email)
    {
        $sql = "SELECT * from `admin` where email like :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            //$query->bindValue(':passwordd',$password);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    //***********************************fonction pour verififer si email existant dans tables users pour google
    function verifierEmail2($emailL)
    {
        $sql1 = "SELECT * FROM users WHERE email = :email";
        $db = config::getConnexion();
        $req1 = $db->prepare($sql1);
        $req1->bindValue(':email', $emailL);
        try {
            $req1->execute();
            $row_count1 = $req1->fetchColumn();
            if ($row_count1 != 0) {

                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    //***********************************Function add without sign up system
    function addUserG($google_id, $f_name, $l_name, $emailG, $gender, $local, $pictureG)
    {

        $sql = "INSERT INTO `users` (`oauth_uid`, `first_name`, `last_name`, `email`, `profile_pic`, `gender`, `local`) VALUES (:id, :f_name, :l_name, :emailG, :pictureG, :gender, :local)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $google_id,
                ':f_name' => $f_name,
                ':l_name' => $l_name,
                ':emailG' => $emailG,
                ':pictureG' => $pictureG,
                ':gender' => $gender,
                ':local' => $local
            ]);
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
}
