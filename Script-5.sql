


create database Escola;
use Escola;
create table alunos(
id int primary key auto_increment,
nome varchar (50),
idade int, 
email varchar (50),
curso varchar (50));
insert into Escola.alunos (id,nome,idade,email,curso)
values("1","Rafael","42","rafael@gmail.com","TI"),
("2","Rafaela","9","rafaela@gmail.com","TI"),
("3","gabriel","13","gbiel@gmail.com","TI"),
("4","fernando","14","fernado@gmail.com","TI");
select*from Escola.alunos;