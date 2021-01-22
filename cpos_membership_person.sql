create table membership_person
(
    membership_id int                                                      not null,
    person_id     int                                                      null,
    fam_status    enum ('primary', 'secondary', 'child') default 'primary' not null,
    constraint membership_person_membership_id_fk
        foreign key (membership_id) references membership (id),
    constraint membership_person_person_id_fk
        foreign key (person_id) references people (id)
);
