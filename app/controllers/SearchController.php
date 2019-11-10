<?php


namespace app\controllers;
use app\models\Search;
class SearchController extends AppController
{
    private $searchModel;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->searchModel = new Search();
        $this->layout = false;
    }

    public function searchAction(){
        $output = '';
        $res = $this->searchModel->search($_POST['search']);
        if (count($res) > 0){
            $output .= "<h4>Search Result</h4>";
             foreach ($res as $row){
                        if ($row['id'] != NUll){
              $output .=  "<div class='border-top'>
                                <div class='row p-3'>
                                    <div class='col-2 mt-2'>
                                        <img src='" . $row['user_dir'].$row['image'] . "' width='30' alt=''>
                                    </div>
                                    <div class='col-10 mt-2'>
                                        <h6>" .  $row['name'] . "</h6>
                                        <a class='text-danger' href='/profiles/viewProfile?id=" . $row['id'] ."'>Show profile</a>
                                    </div>
                                </div>
                            </div>";
                        }
                    }
             echo $output;
        }
        else{
            echo "No found";
        }
    }
}