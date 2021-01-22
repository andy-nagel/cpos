create table people
(
    id         int auto_increment
        primary key,
    first_name varchar(50) null,
    last_name  varchar(50) null,
    phone      varchar(32) null,
    email      varchar(70) null,
    address_id int         null,
    age        tinyint     null,
    constraint person_address_id_fk
        foreign key (address_id) references address (id)
);
