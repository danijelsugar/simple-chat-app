drop database if exists chatapp;

create database chatapp default character set utf8;

#sipanje baze
#c:\xampp\mysql\bin\mysql -uedunova -pedunova --default_character_set=utf8 < E:\htdocs\chat_app\db.sql

use chatapp;

create table signup (
uid int not null primary key auto_increment,
username varchar(200) not null,
email varchar(200) not null,
pass varchar(255) not null
);

create table posts (
id int not null primary key auto_increment,
msg varchar(255) not null,
user int not null,
published datetime not null
);

insert into signup(uid,username,email,pass) values 
(null,'ajeto','blabla@gmail.com','123456');

select 'Sve uspjesno odradeno' as poruka;
