<?php
    $user =  $_SESSION['user'];
    $friends = $info['friends'];
    $request = $info['request'];
    $_SESSION['friend_user'] = $friends;
?>
<div class="container">
    <div class="row mt-5">
        <?php foreach ($data as $res => $val){
        ?>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 mt-2">
            <div class="card">
                <div class="bg-light user-card-header"></div>
                <div class="rounded-circle border user-home-image ">
                    <img class="rounded-circle" src='<?= "{$val['user_dir']}{$val['image']} " ?>' width="100" height="100"
                         alt="user image">
                </div>
                <div class="card-body mt-5 text-center">
                    <h3 class="card-title"><?= $val['name'] ?></h3>
                </div>
                <?php if ($val['id'] == $user['id']) {
                    echo "
                        <div class='d-flex justify-content-center p-3'>
                            <h5>My profile</h5>
                        </div>
                     ";
                } else {
                    if (array_key_exists($val['id'], $friends)) {

                        echo
                        "<div class=' p-3'>
                                <div class=' d-flex justify-content-center'>
                                     <button class=' start_chat bg-danger text-white border h-100 w-100' data-touserid=\"{$val['id']}\" data-username={$val['name']}\">Message</button>
                                </div>
                            </div>";
                    }else{
                        if (array_key_exists($val['id'], $request)) {
                            echo
                            "<div class='row p-3'>
                                <div class='col-md-6 col-lg-6 col-sm-12 col-xs-12 d-flex justify-content-center'>
                                    <button class='btn btn-success'>Request</button>
                                </div>
                                <div class='col-md-6 col-lg-6 col-sm-12 col-xs-12 d-flex justify-content-center'>
                                    <button class='start_chat bg-danger text-white border h-100 w-100' data-touserid=\"{$val['id']}\" data-username={$val['name']}\" > Message</button >
                                </div>
                            </div>";
                        }
                        else{
                            echo
                            "<div class='row p-3'>
                                <div class='col-md-6 col-lg-6 col-sm-12 col-xs-12 d-flex justify-content-center'>
                                    <a href='/user/friend?from={$user['id']}&&to={$val['id']}'   class='btn btn-success'> + Add</a>
                                </div>
                                <div class='col-md-6 col-lg-6 col-sm-12 col-xs-12 d-flex justify-content-center'>
                                    <button class='start_chat bg-danger text-white border h-100 w-100' data-touserid=\"{$val['id']}\" data-username={$val['name']}\">Message</button>
                                </div>
                            </div>";

                        }

                    }
                }?>

                <div class='border-top text-center p-3'>
                    <a href="<?= "/profiles/viewProfile?id={$val['id']}" ?>" class='text-danger'>View profile</a>
                </div>
            </div>
        </div>
        <?php  }?>
    </div>
</div>
<div id="user_model_details"></div>