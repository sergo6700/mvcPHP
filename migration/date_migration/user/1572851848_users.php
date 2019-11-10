<?php


    include '../migration/Migration.php';

    class users extends Migration {

        public function up(){
            $this->create('users','
              `id` int(11) NOT NULL,
              `name` varchar(255) CHARACTER SET utf8 NOT NULL,
              `email` varchar(255) CHARACTER SET utf8 NOT NULL,
              `tel` varchar(50) CHARACTER SET utf8 NOT NULL,
              `password` varchar(255) CHARACTER SET utf8 NOT NULL,
              `user_dir` varchar(255) CHARACTER SET utf8 NOT NULL,
              `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
              `backImage` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
              `isEmailVerified` int(11) NOT NULL DEFAULT \'0\',
              `token` varchar(255) CHARACTER SET utf8 NOT NULL,
              `status` int(11) NOT NULL DEFAULT \'0\'
            ');
            $this->primaryKeys('users', "ADD PRIMARY KEY (`id`)");
            $this->autoIncrement('users', 'id');
            $this->insertInto('users',"
                (`id`, `name`, `email`, `tel`, `password`, `user_dir`, `image`, `backImage`, `isEmailVerified`, `token`, `status`) VALUES
                (101, 'Nicole Richie', 'seroj6700@gmail.com', '+37493852924', '81dc9bdb52d04dc20036dbd8313ed055', '/uploads/A;f(S-Kajo/', 'bandmember.jpg', '/uploads/A;f(S-Kajo/map.jpg', 1, '', 0),
                (102, 'Jane Birkin', 'grigoryanserg98@gmail.com', '+37493852929', '81dc9bdb52d04dc20036dbd8313ed055', '/uploads/fsajoaJiDd/', 'ny.jpg', '/uploads/fsajoaJiDd/images.jpeg', 1, '', 0),
                (103, 'John Doe', 'sergrigoryan98@gmail.com', '+37493852929', '81dc9bdb52d04dc20036dbd8313ed055', '/uploads/ffiJdasjsF/', 'bird.jpg', '/uploads/ffiJdasjsF/images.jpeg', 1, '', 0)
            ");
        }

        public function down(){
            $this->drop('users');
        }

}