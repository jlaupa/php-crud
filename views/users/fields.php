<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card blue-grey darken-2">
                <div class="card-content white-text">
                    <div class="row center">
                        <span class="card-title border-bottom"><b>Add de User</b></span>
                        <pre>
                        <?php
                        if (isset($_GET['msg'])) {
                            echo "<span class='error'><b>{$_GET['msg']}</b></span>";
                        }
                        ?>
                    </div>
                    <div class="row">
                        <form role="form" method="post" class="col s12" action="">
                            <div class="row">
                                <input name="id" type="text" value="<?=$user->id ?? ''?>" hidden>

                                <div class="input-field col s6">
                                    <input name="username" type="text"
                                           class="validate" value="<?=$user->username ?? ''?>"
                                           <?=(isset($user->id))? 'disabled':''?> required>
                                    <label>Username</label>
                                </div>

                                <div class="input-field col s6">
                                    <input name="email" type="text"  value="<?=$user->email ?? ''?>">
                                    <label>Email</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="password" type="text" class="validate" value="<?=$user->password ?? ''?>" required>
                                    <label>Password</label>
                                </div>

                                <div class="input-field col s6">
                                    <input name="name" type="text" value="<?=$user->name ?? ''?>">
                                    <label>Name</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s3">
                                    <input type="submit" class="btn waves-effect waves-light" name="save" value="save">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>