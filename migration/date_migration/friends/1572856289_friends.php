<?php


    include '../migration/Migration.php';

    class friends extends Migration {

               public function up(){
                   $this->create('friends', "
                      `id` int(11) NOT NULL,
                      `from_user` int(11) NOT NULL,
                      `to_user` int(11) NOT NULL,
                      `status` int(11) NOT NULL DEFAULT '0'
                   ");
                   $this->primaryKeys('friends', "
                          ADD PRIMARY KEY (`id`),
                          ADD KEY `from_user` (`from_user`),
                          ADD KEY `to_user` (`to_user`);
                   ");
                   $this->autoIncrement('friends', "id");
                   $this->insertInto('friends', "
                        (`id`, `from_user`, `to_user`, `status`) VALUES
                        (7, 103, 101, 1),
                        (8, 102, 101, 1)
                   ");
                   $this->foreignKey('friends', "
                    ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                    ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                   ");
               }

               public function down(){
                   $this->drop('friends');
               }

}