<?php
include_once "../config.php";
include_once "../controller/UserC.php";
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $sql = "SELECT * FROM `user` WHERE `ID` LIKE :dataa OR `LASTNAME` LIKE :dataa OR `FIRSTNAME` LIKE :dataa";
    $sql1 = "SELECT * FROM `users` WHERE `id` LIKE :dataa OR `first_name` LIKE :dataa OR `last_name` LIKE :dataa";
    $db = config::getConnexion();
    $result = $db->prepare($sql);
    $result->bindValue(':dataa','%'.$input.'%');
    $result1 = $db->prepare($sql1);
    $result1->bindValue(':dataa','%'.$input.'%');
    $row_count = $result->fetchColumn();
    $result->execute();
    $result1->execute();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            echo '<div class="user-card" >
            <img id="userImage" src="data:image/png;base64,'. base64_encode($row['PICTURE']).'" alt="User Image" 9 />
            <h2>ID: ' . $row['ID'] .'</h2>
            <h3>Nom:' .$row['LASTNAME'] .'</h3>
            <h3>Prenom: ' .$row['FIRSTNAME'].'</h3>
            <p>Email: '. $row['EMAIL'] .'</p>
            <p>Mot de passe: ##########</p>
            <p>DoB: ' .$row['DOB']. '</p>
            <br>
                    <div class="div1">
                        <form method="POST" action="updatePanel.php" class="formBtn">
                            <input style="display:flex; width: 25px; height:25px; margin-left:247px;" class="input1" type="image" name="update" src="../img/cogwheel.png">
                            <input type="hidden" value="'. $row['ID'].'" name="idUser">
                        </form>
                    </div>
                    <div class="div2"><a href="deleteUser.php?idUser="'.$row['ID'].'"><img class="trashCan" style="width: 25px; height: 25px; margin-left:247px; margin-top:30px;" src="../img/garbage.png" alt="tashCan-image"></a></div>
                    </div>';
                    
        }
        while($row = $result1->fetch(PDO::FETCH_ASSOC))
        {
            echo '<div class="user-card" style="margin-top:0px;position: relative;" >
            <img id="userImage" src="'. $row['profile_pic'].'" alt="User Image" 9 />
            <h2>ID: ' . $row['id'] .'</h2>
            <h3>Nom:' .$row['last_name'] .'</h3>
            <h3>Prenom: ' .$row['first_name'].'</h3>
            <p>Email: '. $row['email'] .'</p>
            <br>
                    <div class="div2"><a href="deleteUserG.php?idUser="'.$row['id'].'"><img class="trashCan" style="width: 25px; height: 25px; margin-left:247px; margin-top:30px;" src="../img/garbage.png" alt="tashCan-image"></a></div>
                    </div>';
                    
        }
        // if($row_count == 0){
        //     echo "<b style='color:red; ' >No Data Found!</b>";
        // }
    
}

    ?>