create table membership
(
    id    int auto_increment
        primary key,
    type  int  not null,
    start date not null,
    constraint membership_membership_type_id_fk
        foreign key (type) references membership_type (id)
);
