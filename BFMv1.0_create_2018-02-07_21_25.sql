
-- tables
-- Table: web_object
CREATE TABLE web_object (
    ID bigint(20) NOT NULL,
    wobj_content text NOT NULL,
    wobj_type varchar(20) NOT NULL,
    wobj_title text NOT NULL,
    wobj_status bool NOT NULL,
    wobj_date date NOT NULL,
    CONSTRAINT web_object_pk PRIMARY KEY (ID)
);
-- End of file.

