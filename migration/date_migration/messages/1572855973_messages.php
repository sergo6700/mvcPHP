<?php


    include '../migration/Migration.php';

    class messages extends Migration {

               public function up(){
                   $this->create('messages', "
                      `id` int(11) UNSIGNED NOT NULL,
                      `from_user` int(11) NOT NULL,
                      `to_user` int(11) NOT NULL,
                      `message` varchar(255) COLLATE utf8_general_ci NOT NULL,
                      `data` date NOT NULL
                   ");
                   $this->primaryKeys('messages', "
                      ADD PRIMARY KEY (`id`),
                      ADD KEY `from_user` (`from_user`),
                      ADD KEY `to_user` (`to_user`);
                   ");
                   $this->autoIncrement('messages', "id");
                   $this->insertInto('messages', "");
                   $this->foreignKey('messages', '
                        ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                        ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                   ');
               }

               public function down(){
                   $this->drop('messages');
               }

}