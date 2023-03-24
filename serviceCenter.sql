create database serviceCenter;
use serviceCenter;

create table utilizadores (
    codUtilizador int primary key not null auto_increment,
    nome varchar(32),
    email varchar(32),
    pass varchar(30)
);

create table equipamentos (
    codEquipamento int primary key not null auto_increment,
    partNumber varchar (32),
    serialNumber varchar (32),
    quantidade int
);

create table trabalhos (
    codTrabalho int primary key not null auto_increment,
    observacao varchar(500),
    equipamentosUsados varchar(32),
    duracao time,
    dia date,
    codUtilizador int references utilizadores(codUtilizador),
    codEquipamento int references equipamentos(codEquipamento)
);
