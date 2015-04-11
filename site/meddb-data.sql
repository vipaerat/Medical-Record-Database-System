insert into Patient values('ankitk@iitrpr.ac.in', 'Ankit Khokhar','male','1993-01-26' );
insert into Patient values('ankitkhokhar@iitrpr.ac.in', 'Ankit Khokhar','male','1993-01-26' );
insert into Patient values('ankitkhokhar@gmail.com', 'Ankit Khokhar','male','1993-01-26' );
insert into Patient values('anshuman@gmail.com', 'Anshuman Yadav','male','1994-04-23' );
insert into Patient values('adityaa@iitrpr.ac.in', 'Aditya Abhas','male','1994-08-20' );
insert into Patient values('balwinder@iitrpr.ac.in', 'Balwinder Sodhi','male','1973-01-26' );
insert into Patient values('ranjana@iitrpr.ac.in', 'Ranjana Sodhi','female','1983-01-26' );
insert into Patient values ('vipina@iitrpr.ac.in','Vipin A','male','1993-01-26');

insert into Pharmacist values ('rachit@iitrpr.ac.in','Rachit Arora','Pharmacy','234','Ropar','Punjab','140001','2012-06-23');
insert into Pharmacist values ('bedi@iitrpr.ac.in','Agam Badi','Pharmacy',null,null,null,null,'2015-01-04');

insert into Student values('ankitkhokhar@iitrpr.ac.in', '2012CSB1089','Mercury-A','317','abcd','9234567890',null,null,null,null );
insert into Student values('anshuman@gmail.com', '2012CSB1047','Mercury-A','217','9345678901','123','Alwar','Rajasthan',12342 );


insert into Employee values('balwinder@iitrpr.ac.in',null,'Chandigarh','Punjab',12345);
insert into Employee values('ranjana@iitrpr.ac.in','123-A','Mohali','Punjab',1235);


insert into Faculty values ('balwinder@iitrpr.ac.in','Computer Science');
insert into Faculty values ('ranjana@iitrpr.ac.in','Electrical');


insert into Doctor values ('vipina@iitrpr.ac.in','Vipin A','M.B.B.S','Nueroscience','312','Ropar','Punjab','140001','2012-07-26');
insert into Doctor values ('gaurav@iitrpr.ac.in','Gaurav Kushwaha','B.D.S','Dentist','312','Ropar','Punjab','140001','2012-07-24');
insert into Doctor values('anshuman@gmail.com', 'Anshuman Yadav','B.D.S','Dentist','312','Ropar','Punjab','140001','2012-07-24');


INSERT INTO doctor (id_doc, name, qualification, field, house_no, city, state, pin_code, joining_date) VALUES ('abc@gmail.com', 'Abc', 'Mbbs', 'Homeopathic', '5432', 'Ropar', 'Punjab', 140001, '2012-01-18');
INSERT INTO doctor (id_doc, name, qualification, field, house_no, city, state, pin_code, joining_date) VALUES ('cdf@gmail.com', 'cdf', 'Mbbs', 'Allopathic', '3128', 'Chandigarh', NULL, 130345, '2013-12-23');

INSERT INTO pharmacist (id_pha, name, qualification, house_no, city, state, pin_code, joining_date) VALUES ('xyz@iitrpr.ac.in', 'XYZ', 'B.Pharma', '8080', 'Ludhiana', 'Punjab', 120023, '2015-12-12');
INSERT INTO pharmacist (id_pha, name, qualification, house_no, city, state, pin_code, joining_date) VALUES ('pharm@iitrpr.ac.in', 'Pharm', 'B.Pharma', '22', 'Patiala', 'Punjab', 120623, '2015-06-02');

INSERT INTO prescription (id_doc, id_pat, id_pha, time_stamp, description, medical_cert) VALUES ('abc@gmail.com', 'adityaa@iitrpr.ac.in', 'xyz@iitrpr.ac.in', '2015-01-08 04:05:06', 'Need break from coding', NULL);
INSERT INTO prescription (id_doc, id_pat, id_pha, time_stamp, description, medical_cert) VALUES ('cdf@gmail.com', 'anshuman@gmail.com', 'xyz@iitrpr.ac.in', '2013-01-09 09:06:10', 'agfsbvsjkbgoeui', NULL);
INSERT INTO prescription (id_doc, id_pat, id_pha, time_stamp, description, medical_cert) VALUES ('cdf@gmail.com', 'ankitkhokhar@iitrpr.ac.in', 'xyz@iitrpr.ac.in', '2015-01-09 09:06:10', 'bsdhjgvblsdbvskdbfoisev', NULL);
INSERT INTO prescription (id_doc, id_pat, id_pha, time_stamp, description, medical_cert) VALUES ('cdf@gmail.com', 'balwinder@iitrpr.ac.in', 'xyz@iitrpr.ac.in', '2014-02-09 09:06:10', 'fjbvjkdskv dskb', NULL);
INSERT INTO prescription (id_doc, id_pat, id_pha, time_stamp, description, medical_cert) VALUES ('cdf@gmail.com', 'anshuman@gmail.com', 'xyz@iitrpr.ac.in', '2014-01-10 09:06:10', 'faeg e ggpg egpege', NULL);
insert into Prescription values ('gaurav@iitrpr.ac.in','ankitk@iitrpr.ac.in','bedi@iitrpr.ac.in','2015-04-11','Root Canal',null);
insert into Prescription values ('anshuman@gmail.com','vipina@iitrpr.ac.in','rachit@iitrpr.ac.in','2015-03-12','No Brains At All',null);
insert into Prescription values ('gaurav@iitrpr.ac.in','balwinder@iitrpr.ac.in','bedi@iitrpr.ac.in','2014-12-31','Remove 5 teeth',null);