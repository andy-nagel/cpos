create table interest_reason
(
    id   int auto_increment
        primary key,
    name varchar(32) not null,
    constraint interest_reason_name_uindex
        unique (name)
);

INSERT INTO cpos.interest_reason (id, name) VALUES (1, 'Advertising');
INSERT INTO cpos.interest_reason (id, name) VALUES (4, 'Box Office');
INSERT INTO cpos.interest_reason (id, name) VALUES (7, 'Costumes');
INSERT INTO cpos.interest_reason (id, name) VALUES (10, 'Design');
INSERT INTO cpos.interest_reason (id, name) VALUES (13, 'Directing');
INSERT INTO cpos.interest_reason (id, name) VALUES (16, 'Hair');
INSERT INTO cpos.interest_reason (id, name) VALUES (2, 'Lighting');
INSERT INTO cpos.interest_reason (id, name) VALUES (5, 'Maintenance');
INSERT INTO cpos.interest_reason (id, name) VALUES (8, 'Make-up');
INSERT INTO cpos.interest_reason (id, name) VALUES (11, 'Marketing');
INSERT INTO cpos.interest_reason (id, name) VALUES (14, 'Membership');
INSERT INTO cpos.interest_reason (id, name) VALUES (17, 'Painting');
INSERT INTO cpos.interest_reason (id, name) VALUES (3, 'Performance');
INSERT INTO cpos.interest_reason (id, name) VALUES (6, 'Props');
INSERT INTO cpos.interest_reason (id, name) VALUES (9, 'Set Building');
INSERT INTO cpos.interest_reason (id, name) VALUES (15, 'Sound');
INSERT INTO cpos.interest_reason (id, name) VALUES (12, 'Stage Crew');
INSERT INTO cpos.interest_reason (id, name) VALUES (18, 'Ushering');