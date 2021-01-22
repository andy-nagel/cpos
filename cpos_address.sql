create table address
(
    id      int auto_increment
        primary key,
    street1 varchar(64) null,
    street2 varchar(64) null,
    city    varchar(50) null,
    state   varchar(32) null,
    zipcode varchar(20) null
);

