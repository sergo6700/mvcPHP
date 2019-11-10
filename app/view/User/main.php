<div class="container">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 mt-5 p-3">
            <div class="card">
                <div class="bg-danger user-card-header"></div>
                <div class="rounded-circle border user-home-image ">
                    <img class="rounded-circle" src="<?= "{$user_dir}{$image}" ?>" width="100" height="100" alt="user image">
                </div>
                <div class="card-body mt-5 text-center">
                    <h3 class="card-title"><?= $name ?></h3>
                    <p class="card-text">Quick sample text to create the card title and make up the body of the card's content.</p>
                </div>
                <div class="border-top text-center pt-2">
                    <h3>Friends</h3>
                    <h4><?= (!isset($friends)) ? 0 : count($friends)?></h4>
                </div>
                <div class="border-top text-center pt-2">
                    <h3>Stories</h3>
                    <h4><?= (isset($mystories) && !empty($mystories)) ? count($mystories) : 0 ?></h4>
                </div>
                <div class="border-top text-center p-3">
                    <a href="/user/myPage" class="text-danger">View profile</a>
                </div>
            </div>
            <div class="card mt-4">
                <div class="sugestions p-2">
                    <h4>Sugestions</h4>
                </div>

                <?php
                if (array_key_exists($id, $sugestions)){
                    echo '';
                }else{
                    foreach ($sugestions as $res){
                        if ($res['id'] != NULL){?>
                            <div class="border-top friend-info">
                                <div  onclick="ConfirmSuggestion(this)" data-id="<?= $res['id']?>" class="ml-2"><strong>x</strong></div>
                                <div class="row p-3">
                                    <div class="col-2 ">
                                        <img src="<?= "{$res['user_dir']}{$res['image']}"?>" width="30" alt="">
                                    </div>
                                    <div class="col-8">
                                        <h6><?= $res['name']?></h6>
                                        <p>Friend request</p>
                                    </div>
                                    <div class="col-2">
                                        <a class="add-friend " href='<?= "/user/addFriend?id={$res['id']}"?>'><i class="fas fa-plus-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        else{
                            return '';
                        }
                    }
                } ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 mt-5 p-3">
            <div class="story bg-light">
                <div class="row ">
                    <div class="col-2 ">
                        <img src="<?=$user_dir . $image?>" width="50" height="50" class="m-3 rounded-circle" alt="">
                    </div>
                    <div class="col-10  ">
                        <button type="button" class="btn btn-danger float-right m-4" data-toggle="modal" data-target="#exampleModalCenter">
                            Post story
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title " id="exampleModalLongTitle">Post a creative story</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-2">
                                        <form action="/user/post" id="story_form" method="post">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <div id="errTitle"></div>
                                            <div class="form-group">
                                                <input type="text"  class="form-control" id="titlePost" placeholder="Title" name="title">
                                            </div>
                                            <div id="errStory"></div>
                                            <div class="form-group">
                                                <textarea class="form-control"  rows="5" id="storyPost" name="story" placeholder="Write your story..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger w-100">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 mt-5 p-3">
            <div class="card mt-4">
                <div class="sugestions p-2">
                    <h4>Friends</h4>
                </div>
                <?php foreach ($friends as $row){
                    if ($row['id'] != NUll){?>
                <div class="border-top">
                    <div class="row p-3  border-top friend-info">
                        <div  onclick="ConfirmDelete(this)" data-id="<?= $row['id']?>" class="deleteFriend"><strong>x</strong></div>
                        <div class="d-flex friend-info  justify-content-md-center justify-content-sm-center col-sm-12 col-md-12  mt-2">
                            <img src='<?= $row['user_dir'].$row['image'] ?>' width="30" alt="">
                        </div>
                        <div class="d-flex justify-content-md-center justify-content-sm-center col-sm-12 col-md-12   mt-2">
                            <h6><?= $row['name'] ?></h6>
                        </div>
                        <div class="d-flex justify-content-md-center justify-content-sm-center col-sm-12 col-md-12  mt-2">
                            <a class="text-danger" href="<?= "/profiles/viewProfile?id={$row['id']}"?>">Show profile</a>
                        </div>
                        <div class="d-flex justify-content-md-center justify-content-sm-center col-sm-12 col-md-12  mt-2 p-3 ">
                            <button class="fab fa-facebook-messenger start_chat bg-danger text-white border h-100 w-100" data-touserid="<?=$row['id']?>" data-username="<?= $row['name']?>"></button>
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
</div>