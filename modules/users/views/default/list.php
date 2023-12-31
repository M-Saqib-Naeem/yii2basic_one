<?php
// use Yii;
?>
<div class="row">
    <div class="col-12 mx-auto p-5">
        <div class="mb-3">
            <h1>Users List</h1>

            <table class="table">
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email Address</th>
                    <th>Gender & Age</th>
                    <th>Action</th>
                </tr>
                <?php 
                if( is_array( $users ) && count( $users ) > 0 ) :
                foreach( $users as $user ) : ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td>
                            <?= $user->full_name; ?> <br/>
                            <small><i><?= ( $user->role == 1 ) ? 'Admin' : 'Subscriber'; ?></i></small>
                        </td>
                        <td><?= $user->email_address; ?></td>
                        <td>
                            <?= ( ! $user->gender ) ? "NA" : ( $user->gender == 1 ? "Male" : "Female" ); ?> | 
                            <?= ( $user->age ) ? $user->age : "N/A"; ?>
                        </td>
                        <td>
                            <?php 
                            if( $user->role == 1 ) {
                                echo '/';
                            }else{
                            ?>
                            <a href="#">Delete</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                endforeach; 
                else:
                ?>
                <tr>
                    <td colspan="5" class="text-center">No records found!</td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>