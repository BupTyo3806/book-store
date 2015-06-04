DROP TABLE status CASCADE CONSTRAINTS; 
CREATE TABLE status
    ( 
     id NUMBER(4) PRIMARY KEY, 
     name VARCHAR2(9) NOT NULL CHECK (name IN ('admin','user','courier'))
    );
/
DROP TABLE person CASCADE CONSTRAINTS; 
CREATE TABLE person
    ( 
     id NUMBER(4) PRIMARY KEY,
	 status_id REFERENCES status(id),
	 lastname VARCHAR2(50) NOT NULL,
	 firstname VARCHAR2(50) NOT NULL,
	 middlename VARCHAR2(50),
	 login VARCHAR2(10) UNIQUE NOT NULL,
	 password VARCHAR2(32) NOT NULL
    );
/	
DROP SEQUENCE person_s; 
CREATE SEQUENCE person_s NOCACHE ORDER; 
/	
CREATE OR REPLACE TRIGGER person_t 
     BEFORE INSERT ON person 
     FOR EACH ROW 
       BEGIN 
        SELECT person_s.NEXTVAL 
       INTO :new.id FROM DUAL; 
     END;
/
DROP TABLE request CASCADE CONSTRAINTS; 
CREATE TABLE request
    ( 
     id NUMBER(4) PRIMARY KEY,
	 person_id REFERENCES person(id) NOT NULL,
	 courier_id REFERENCES person(id),
	 begindate DATE NOT NULL,
	 shipstat VARCHAR2(50),
	 latitude VARCHAR2(20) NOT NULL,
	 longitude VARCHAR2(20) NOT NULL
    );
/	
DROP SEQUENCE request_s; 
CREATE SEQUENCE request_s NOCACHE ORDER; 
/	
CREATE OR REPLACE TRIGGER request_t 
     BEFORE INSERT ON request 
     FOR EACH ROW 
       BEGIN 
        SELECT request_s.NEXTVAL 
       INTO :new.id FROM DUAL; 
     END;
/
DROP TABLE product CASCADE CONSTRAINTS; 
CREATE TABLE product
    ( 
     id NUMBER(4) PRIMARY KEY,
	 isbn VARCHAR2(17),
	 title VARCHAR2(50) NOT NULL,
	 author VARCHAR2(50) NOT NULL,
	 description VARCHAR2(4000) NOT NULL,
	 genre VARCHAR2(50) NOT NULL
    );
/	
DROP SEQUENCE product_s; 
CREATE SEQUENCE product_s NOCACHE ORDER; 
/	
CREATE OR REPLACE TRIGGER product_t 
     BEFORE INSERT ON product 
     FOR EACH ROW 
       BEGIN 
        SELECT product_s.NEXTVAL 
       INTO :new.id FROM DUAL; 
     END;
/
DROP TABLE request_product CASCADE CONSTRAINTS; 
CREATE TABLE request_product
    (  
     request_id REFERENCES request(id),
     product_id REFERENCES product(id),
	 number NUMBER(10) NOT NULL,
     CONSTRAINT PRIMARY KEY (request,product)  
    ); 
commit;