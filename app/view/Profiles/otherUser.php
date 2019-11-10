<?php $user_friends = $_SESSION['friend_user'] ;
$user = $_SESSION['user'];

?>
<div class="p-0 m-0 cover back-image">
    <img src="<?= "$backImage" ?>" class="img-fluid w-100 h-100" alt="Responsive image">
</div>
<div class="container">
    <div class="row m-0 p-0">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 p-3">
            <div class="card-user-other bg-light m-0">
                <div class="border-circle centered-user">
                    <img  src="<?= "{$user_dir}{$image}" ?>" width="130" height="130" class=" rounded-circle"  alt="">
                </div>
                <div class="row mt-0 p-0">
                    <?php
                        if (array_key_exists($id, $user_friends)){
                            echo "<div class='col-12 d-flex justify-content-center'>
                                <button class='start_chat btn btn-primary text-white border ' data-touserid=\"{$id}\" data-username={$name}\">Message</button>
                            </div>";
                    }else{
                            if (array_key_exists($user['id'], $request)) {
                                echo "<div class='col-6 d-flex justify-content-center'>
                                        <button class='btn btn-success'>Request</button>
                                        </div>
                                        <div class='col-6 d-flex justify-content-center'>
                                             <button class='start_chat btn btn-primary text-white border ' data-touserid=\"{$id}\" data-username={$name}\">Message</button>
                                        </div>";

                            }
                            else{
                                echo "<div class='col-6 d-flex justify-content-center'>
                                        <a href='/user/friend?from={$_SESSION['user']['id']}&&to={$id}' class='btn btn-success'> + Add</a>
                                        </div>
                                        <div class='col-6 d-flex justify-content-center'>
                                             <button class='start_chat btn btn-primary text-white border ' data-touserid=\"{$id}\" data-username=\"{$name}\">Message</button>
                                        </div>";
                            }
                    } ?>


                    <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12 mt-2">
                        <div class="text-center pt-2">
                            <h3>Friends</h3>
                            <h4><?= (isset($friends) && empty($friends)) ? 0 : count($friends)?></h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12 mt-2">
                        <div class="text-center pt-2">
                            <h3>Stories</h3>
                            <h4><?= (isset($story) && !empty($story)) ? count($story) : 0 ?></h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Friends</h5>
                </div>
                <div class="border-top">

                    <?php foreach ($friends as $row){
                        if ($row['id'] != NUll){?>
                            <div class="border-top">
                                <div class="row p-3">
                                    <div class="col-2 mt-2">
                                        <img src='<?= $row['user_dir'].$row['image'] ?>' width="30" alt="">
                                    </div>
                                    <div class="col-10 mt-2">
                                        <h6><?= $row['name'] ?></h6>
                                        <a class="text-danger" href="<?= "/profiles/viewProfile?id={$row['id']}"?>" >Show profile</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        else{
                            return '';
                        }
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 mt-5 p-3">
            <div class="d-none d-sm-block d-sm-none d-md-block">
                <h3><?= $name ?></h3>
                <p>Graphic Designer at Self Employed</p>
            </div>
            <div class="tebs">
                <ul class="nav nav-pills mb-3 bg-light border d-flex justify-content-center"  id="pills-tab" role="tablist">
                    <li class="nav-item p-3 text-center">
                        <a class="active text-danger  text-decoration-none" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                            <img class="mx-auto" src="/images/ic1.png" alt="">
                            <p>Feed</p>
                        </a>
                    </li>
                    <li class="nav-item p-3 text-center">
                        <a class="text-danger text-decoration-none" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                            <img class="ml-auto mr-auto" src="/images/ic2.png" alt="">
                            <p>Info</p>
                        </a>
                    </li>
                    <li class="nav-item p-3 text-center" >
                        <a class="text-danger text-decoration-none" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                            <img src="/images/ic3.png" alt="">
                            <p class="">Portfolio</p>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <?php
                        if (!empty($story)){
                            if (!in_array(NULL, $story[0])){
                                foreach ($story as $res){?>
                                    <div class="mt-4 p-3 border bg-light">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="<?= $res['user_dir']. $res['image']?>" width="50" alt="">
                                            </div>
                                            <div class="col-10">
                                                <h5 class="d-inline"><?= $res['name']?></h5>
                                                <p class="time"><i class="far fa-clock"></i> <?= time_elapsed_string($res['created'])?></p>
                                            </div>
                                        </div>
                                        <div class="mt-2 border-top pt-2">
                                            <h4><?= $res['title'] ?></h4>
                                            <p class="ml-1">
                                                <?= $res['story'] ?>
                                            </p>
                                        </div>
                                        <div class="mt-2 border-top pt-2">
                                            <p class="text-danger d-inline"><i class="fas fa-heart"></i> Like</p>
                                            <p class="d-inline time text-green">14</p>
                                            <p class="text-danger d-inline ml-4"><i class="fas fa-comments"></i> Comments</p>
                                            <p class="d-inline time text-green">14</p>
                                        </div>
                                    </div>
                                <?php     }
                            }
                        }?>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="mt-4 p-3 border bg-light">
                            <div class="row p-3">
                                <h5>Overview</h5>
                                <p class="text-h6">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam asperiores at commodi deleniti dolorum ea et facilis fugiat harum labore magnam quis quisquam, quos sint tempora tempore ullam vel!
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 border bg-light">
                            <div class="row p-3">
                                <h5>Experience</h5>
                                <p class="text-h6">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam asperiores at commodi deleniti dolorum ea et facilis fugiat harum labore magnam quis quisquam, quos sint tempora tempore ullam vel!
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias est laborum nisi non odio officia sint sunt suscipit, tempora? Dolores eum ex natus nesciunt nisi odit quo repellendus! Nulla, ullam!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="mt-4 p-3 border bg-light">
                            <div class="row p-3">
                                <?php foreach ($portfolio as $key => $val){?>
                                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 p-1">
                                        <img class="w-100" width="150" height="150" id="<?= "image{$portfolio[$key]['id']}"?>" ondblclick="imageThis(this.src)" src="<?=$portfolio[$key]['path']?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 mt-5 p-3">
            <div class="mt-4 p-3 border bg-light">
                <div>
                    <h5 class="d-inline">Portfolio</h5>
                    <i class="fas fa-images float-right"></i>
                </div>
                <div class="row p-3">
                    <?php if (!empty($portfolio)){
                        foreach ($portfolio as $key => $val){?>
                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 p-1">
                                <img class="w-100" width="100" height="50" src="<?=$portfolio[$key]['path']?>" alt="">
                            </div>
                        <?php }
                    } else{
                        echo '';
                    }?>
                </div>
                <div class="border-top text-center p-2 ">
                    <a href="" class=" text-danger text-decoration-none">Show all</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="user_model_details"></div>