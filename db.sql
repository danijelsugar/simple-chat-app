drop database if exists chatapp;

create database chatapp default character set utf8;

#sipanje baze
#c:\xampp\mysql\bin\mysql -uedunova -pedunova --default_character_set=utf8 < E:\htdocs\chat_app\db.sql

use chatapp;

create table signup (
uid int not null primary key auto_increment,
username varchar(200) not null,
email varchar(200) not null,
pass varchar(255) not null,
description varchar(255),
image varchar(255) 
);

create unique index uq_email on signup(email);

create table posts (
id int not null primary key auto_increment,
msg varchar(255) not null,
username int not null,
published DATETIME DEFAULT CURRENT_TIMESTAMP not null
);

create table privatemsg (
id int not null primary key auto_increment,
toid int not null,
fromid int not null,
msg varchar(255) not null,
timesent DATETIME DEFAULT CURRENT_TIMESTAMP not null
);



alter table posts add foreign key (username) references signup(uid);

alter table privatemsg add foreign key (toid) references signup(uid);
alter table privatemsg add foreign key (fromid) references signup(uid);

insert into signup(uid,username,email,pass) values 
(null,'ajeto','blabla@gmail.com','123456');

insert into posts(id,msg,username) values 
(null,'eee disi',1);

insert into privatemsg(id,toid,fromid,msg) values 
(null, 1, 2, 'disi');

select 'Sve uspjesno odradeno' as poruka;
