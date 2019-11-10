<?php


    include '../migration/Migration.php';

    class dirs extends Migration {

               public function up(){
                   $this->create('dirs', "
                      `id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `path` varchar(255) CHARACTER SET utf8 NOT NULL
                   ");
                   $this->primaryKeys('dirs', "
                   ADD PRIMARY KEY (`id`),
                   ADD KEY `user_id` (`user_id`);
                   ");
                   $this->autoIncrement('dirs', "id");
                   $this->insertInto('dirs', "
                        (`id`, `user_id`, `path`) VALUES
                        (2, 141, '/uploads/ffjkdiAekf/cover-img.jpg'),
                        (3, 141, '/uploads/ffjkdiAekf/44-hd-real-space-wallpapers-1080p-download-free-beautiful-high-1920x1080-hd.jpg'),
                        (4, 140, '/uploads/FDaKSajJaa/website.jpg'),
                        (5, 142, '/uploads/(ffAaeKoF)/images.jpeg');    
                   ");
                   $this->foreignKey('dirs','
                   ADD CONSTRAINT `dirs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
                   ');
               }

               public function down(){
                   $this->drop('dirs');
               }

}