<?php
include('../../Models/User.php');
require_once '../../header.php';

$users = new User();
$getAllUsers = $users->all();
?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title border-bottom"><b>List Users</b></span>
                    <?php
                    if (isset($_GET['msg'])) {
                        echo "<span class='error'><b>{$_GET['msg']}</b></span>";
                    }
                    ?>
                    <div class="row">
                            <a class="btn  btn-floating waves-effect waves-light" href="store.php">
                                <i class="material-icons right">add</i>
                            </a>
                    </div>
                    <p>
                        Se encontrarón <?=count($getAllUsers)?> resultados
                    </p>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php

                        foreach ($getAllUsers as $user) {
                         echo '
                            <tr>
                                <td>'.$user->id.'</td>                                                        
                                <td>'.$user->username.'</td>                                                        
                                <td>'.$user->email.'</td>                                                        
                                <td>'.$user->name.'</td>                   
                                <td><a href="store.php?id='.$user->id.'">Edit</a></td>                   
                                <td><a href="destroy.php?id='.$user->id.'">Delete</a></td>                   
                            </tr>
                            ';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include '../../footer.php'
?>