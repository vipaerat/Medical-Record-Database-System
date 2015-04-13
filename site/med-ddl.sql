delete from patient;
delete from student;
delete from employee;
delete from faculty;
delete from employee;
delete from doctor;
delete from pharmacist;
delete from prescription;
delete from std_phone;
delete from emp_phone;
delete from pha_phone;
delete from doc_phone;


insert into Patient values ('adityaa@iitrpr.ac.in', 'Aditya Abhas','male','1994-08-20' );
insert into Patient values ('balwinder@iitrpr.ac.in', 'Balwinder Sodhi','male','1973-01-26' );
insert into Patient values ('ranjana@iitrpr.ac.in', 'Ranjana Sodhi','female','1983-01-26' );
insert into Patient values ('ckn@iitrpr.ac.in', 'C K Narayan','male','1985-03-11' );
insert into Patient values ('vipina@iitrpr.ac.in','Vipin A','male','1994-01-26');
insert into Patient values ('gauravku@iitrpr.ac.in','Gaurav Kushwaha','male','1993-01-26');
insert into Patient values ('rachitar@iitrpr.ac.in','Rachit Arora','male','1993-05-12');

insert into Student(id_std,entry_no,hostel_name,room_no,gaurdian_name,gaurdian_phone,house_no,city,state,pin_code) values
	('adityaa@iitrpr.ac.in', '2012CSB1002','Mercury-A','307','goodboy','9234567890','112','Patna','Bihar',110100);

insert into Student values('vipina@iitrpr.ac.in', '2012CSB1038','Mercury-A','306','abcd','9798992823','333','Palakkad','Kerala',678582);
insert into Student values('gauravku@iitrpr.ac.in', '2012CSB1012','Mercury-A','306','hekki','9345678901','123','Secundrabad','Telgana',101000);
insert into Student values('rachitar@iitrpr.ac.in', '2012CSB1026','Mercury-A','208','gaurdian','9345678123','408','Gurgaon','Delhi',110100);

insert into std_phone(id_std,phone_no) values ('adityaa@iitrpr.ac.in',8288909906);
insert into std_phone(id_std,phone_no) values ('vipina@iitrpr.ac.in',8288909903);
insert into std_phone(id_std,phone_no) values ('gauravku@iitrpr.ac.in',8288909911);
insert into std_phone(id_std,phone_no) values ('rachitar@iitrpr.ac.in',8288909676);


insert into Employee values('balwinder@iitrpr.ac.in','322','Chandigarh','Punjab',140001);
insert into Employee values('ranjana@iitrpr.ac.in','123-A','Mohali','Punjab',140001);
insert into Employee values('ckn@iitrpr.ac.in','308-A','Mohali','Punjab',140001);

insert into emp_phone(id_emp,phone_no) values ('balwinder@iitrpr.ac.in',9950322210);
insert into emp_phone(id_emp,phone_no) values ('ranjana@iitrpr.ac.in',9950322211);
insert into emp_phone(id_emp,phone_no) values ('ckn@iitrpr.ac.in',9950322267);


insert into Faculty values ('balwinder@iitrpr.ac.in','Computer Science');
insert into Faculty values ('ranjana@iitrpr.ac.in','Electrical');
insert into Faculty values ('ckn@iitrpr.ac.in','Computer Science');


insert into Doctor values ('vipina82@gmail.com','Vipin A','M.B.B.S','Nueroscience','312','Ropar','Punjab','140001','2012-07-26');
insert into Doctor values ('gauravkushwaha999@gmail.com','Gaurav Kushwaha','B.D.S','Dentist','312','Ropar','Punjab','140001','2012-07-24');
insert into Doctor values('agams@iitrpr.ac.in', 'Agam Singh Bedi','B.D.S','Homeopathic','312','Ropar','Punjab','140001','2012-07-24');

insert into doc_phone(id_doc,phone_no) values ('agams@iitrpr.ac.in',9499221234);
insert into doc_phone(id_doc,phone_no) values ('vipina82@gmail.com',9499221245);
insert into doc_phone(id_doc,phone_no) values ('gauravkushwaha999@gmail.com',9499221223);

insert into doctor (id_doc, name, qualification, field, house_no, city, state, pin_code, joining_date) values ('abc@gmail.com', 'Abc', 'Mbbs', 'Homeopathic', '5432', 'Ropar', 'Punjab', 140001, '2012-01-18');
insert into doctor values ('cdf@gmail.com', 'cdf', 'Mbbs', 'Allopathic', '3128', 'Chandigarh', NULL, 130345, '2013-12-23');

insert into Pharmacist(id_pha, name, qualification, house_no, city, state, pin_code, joining_date) values ('ankitkhokhar@iitrpr.ac.in','Ankit Khokhar','Pharmacy','234','Ropar','Punjab',140001,'2012-06-23');
insert into Pharmacist values ('anshumany@iitrpr.ac.in','Anshuman Yadav','B.Pharma','8080', 'Ludhiana', 'Punjab', 120023, '2015-12-12');

insert into pha_phone(id_pha,phone_no) values ('ankitkhokhar@iitrpr.ac.in',9569884636);
insert into pha_phone(id_pha,phone_no) values ('anshumany@iitrpr.ac.in',9569884668);

insert into prescription (id_doc, id_pat, id_pha, time_stamp, description, medical_cert) values ('agams@iitrpr.ac.in', 'adityaa@iitrpr.ac.in', 'anshumany@iitrpr.ac.in', '2015-01-08 04:05:06', 'Need break from coding', NULL);
insert into prescription values ('vipina82@gmail.com', 'vipina@iitrpr.ac.in', 'ankitkhokhar@iitrpr.ac.in', '2013-01-09 09:06:10', 'Good night sleep', NULL);
insert into prescription values ('vipina82@gmail.com', 'rachitar@iitrpr.ac.in', 'anshumany@iitrpr.ac.in', '2015-01-09 09:06:10', 'Hello World!', NULL);
insert into prescription values ('vipina82@gmail.com', 'gauravku@iitrpr.ac.in', 'ankitkhokhar@iitrpr.ac.in', '2014-02-09 09:06:10', 'Steady flow', NULL);
insert into prescription values ('vipina82@gmail.com', 'gauravku@iitrpr.ac.in', 'anshumany@iitrpr.ac.in', '2014-01-10 09:06:10', 'Beta testing', NULL);
insert into Prescription values ('agams@iitrpr.ac.in','gauravku@iitrpr.ac.in','ankitkhokhar@iitrpr.ac.in','2015-04-11','Star Wars',null);
insert into Prescription values ('agams@iitrpr.ac.in','gauravku@iitrpr.ac.in','anshumany@iitrpr.ac.in','2015-03-12','Game of Thrones',null);
insert into Prescription values ('agams@iitrpr.ac.in','gauravku@iitrpr.ac.in','ankitkhokhar@iitrpr.ac.in','2014-12-31','Remove 5 teeth',null);
