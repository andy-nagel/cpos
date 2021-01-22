create table membership_type
(
    id   int auto_increment
        primary key,
    type varchar(32) not null,
    cost float       null
);

INSERT INTO cpos.membership_type (id, type, cost) VALUES (1, 'Family', 50);
INSERT INTO cpos.membership_type (id, type, cost) VALUES (2, 'Individual', 25);
INSERT INTO cpos.membership_type (id, type, cost) VALUES (3, 'Student', 10);