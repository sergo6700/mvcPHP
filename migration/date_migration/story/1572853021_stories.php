<?php


    include '../migration/Migration.php';

    class stories extends Migration {

               public function up(){
                   $this->create('stories', "
                      `id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `title` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
                      `story` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
                      `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                   ");
                   $this->primaryKeys('stories', "
                            ADD PRIMARY KEY (`id`),
                            ADD KEY `user_id` (`user_id`)
                   ");
                   $this->autoIncrement('stories', "id");
                   $this->insertInto('stories', "
                        (`id`, `user_id`, `title`, `story`, `created`) VALUES
                        (1, 103, 'My first post', 'time is 01 : 02', '2019-11-02 21:03:04')
                   ");
                   $this->foreignKey('stories', 'ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
               }

               public function down(){
                   $this->drop('stories');
               }

}