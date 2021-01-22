create table membership_interests
(
    membership_id      int null,
    interest_reason_id int null,
    constraint membership_interests_interest_reason_id_fk
        foreign key (interest_reason_id) references interest_reason (id),
    constraint membership_interests_membership_id_fk
        foreign key (membership_id) references membership (id)
);
