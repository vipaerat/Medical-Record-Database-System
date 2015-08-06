##Medical Record Database System

###Some useful links:

**Git -**
* https://www.atlassian.com/git/tutorials/
* http://www.vogella.com/tutorials/Git/article.html
* http://www.tutorialspoint.com/git/git_basic_concepts.htm

**Bootstrap -**
* http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/
* http://www.w3schools.com/bootstrap/
* http://getbootstrap.com/getting-started/

###Instructions
Basic site layout can be found in the **site** folder. There are three main folders to work on: **user, doctor and pharmacist**. Teams can add their files to the corresponding folders. Full site for references can be found in **site/sample** folder. You can use the elements from the sample sites like forms, tables, panel, buttons etc or you can search the web for bootstrap elements for front end development. Try to avoid changing the css files in **site/css directory**, this may distort other pages.
**tmp** folder stores the files uploaded to the site, create database based on the configuration given in **config.php** and **site/meddb-ddl**. Populate the database using **site/meddb-data.sql**. Take reference from **site/doctor/index.php** to create home page for pharmacist and user.

###Project Report

CSL 451 - Introduction to Database Systems
Group 6 - Course Project
 
MEDICAL RECORD DATABASE SYSTEM
 
 
Problem statement:
The medical record serves a variety of purposes and is essential to the proper functioning of the Medical practice. The content of the medical record is essential for patient care, analyzing medical history and planning medical facilities.
 
Under the current system of storing medical records in book, it is difficult for the doctor to find out whether there are important factors to consider when treating the person. Under emergency situations if the healthcare staff cannot get the relevant health information quickly, some patients can be at risk.
 
It is also difficult for the individual to tell about all his previous medications.
 
Motivation:
●     Storing electronic medical records is compelling as it is less expensive and efficient.
 
●     To prevent medicine wastage and pilferage.
 
●     Viewing medical history of a patient will be easier.
 
Proposed solution:
The idea is to develop a web app to provide a user friendly interface for the medical database system to keep track of patient’s medical history in an organized way, to make the whole procedure of doctor and patient interaction conducive.
 
The system administrator will hold the premier position. He will be responsible for adding the doctors and pharmacists to the database and deleting them. Patients will have a user profile where they can view their past medical prescriptions and upload their medical reports.
Whenever a patient approaches a doctor for diagnosis, the doctor will be able to access the previous medical history on the basis of his unique ID. This will be followed by the updating of the patient’s profile by the doctor which will include the various attributes namely medicine prescribed, symptoms, tests prescribed etc. After this step, the pharmacist will be notified about the prescription given by the doctor. This will be followed by an authentication process which will involve the confirmation from the patient that he has received the medicines. This will reduce the quantity of the prescribed medicines from the inventory. And this prescription will also be updated in the patient’s profile.
 
Data management needs:
Database will be populated with the profiles of all the users (which includes students, staff, faculties and their dependents) added by the users themselves, medical staff (pharmacist, doctors) added by system administrator.

Database inventory of available medicines will also be required which will be populated and updated by the pharmacist.

Schedule of doctors will be needed which can be updated by the administrator.

Entity Description:
 
Patient:
There will be four types of patients (specialization) –
 
Student - A Student will have a unique email id, name, entry number, hostel address (comprising of room number and hostel name), phone number, date of birth, guardian’s information (comprising of guardian’s name, phone number, house no, city, state, pin code)
 
Faculty - Faculty will have a unique email id, name, department, date of birth, gender, address[house no,city,state,pin code] and phone number(multivalued).
 
Dependents - The Dependents of faculties will have a unique dependent id (which will be assigned to them when their details will be added to the database), name, gender, date of birth, relation to the faculty.
 
Staff - Staff will have a unique email id, name, gender, date of birth, address, phone number.
 
A patient will be able to view his/her previous prescriptions and upload his medical test results. He can view the schedule of doctors as well.

Doctor:
Doctor will have email id for unique identification, name, qualification, field, gender, phone number (multivalued), address and joining date as attributes.
The doctor will be able to view the medicine inventory, but won’t be able to edit it. He will be able to view the medical history of a particular patient and will be able to issue a prescription. The prescription will then be added to the pending prescriptions list of the pharmacist. A doctor can prescribe any available medicine from the available stock to a patient which can be a student, staff member, faculty or any dependent of the faculty. Based upon the prescription of the doctors, each user will have a medical history.
 
Pharmacist:
Pharmacist will have email id for unique identification, Date of birth, phone number (multivalued), address and gender as attributes.
The pharmacist will be able to view the inventory of medicines. The inventory will have details of a medicine such as its quantity and expiry date. She/he will be able to search the inventory for medicines and update it as well.
He will be responsible for giving medicines prescribed by the doctor to the patient, based on the pending prescription.
 
Medicine:
Every medicine will be uniquely identified by its “name” and “mg”. Every medicine can have one or more salts present in them.
Every purchase of medicine will be maintained in the stock with information such as quantity of medicine purchased, expiry date and date of purchase.
 
Schedule:
For every doctor and pharmacist, a schedule will be maintained which will store the day, start time of schedule and end time of schedule.
 
Prescription:
A doctor issues a prescription to a patient which can contain one or more medicines, disease, description (dosage and symptoms etc.), attachments(multivalued) and date of issue.
Every prescription has a single pharmacist who gives the medication, based on the prescription to the patient. The patient can attach multiple test results to a particular prescription and the doctor can also attach a medical certificate corresponding to a particular prescription in the attachment field.


System administrator:
System administrator will have all the permissions of the database. He will be responsible for adding doctors and pharmacists to the system and updating their details.
 
 
Constraints:
       	
1.    One or more doctors and pharmacists can have the same schedule and each doctor and pharmacists can have more than one schedule.
 
2.    Every faculty can have zero or more dependents and each dependent can be related to one or more faculties.
 
3.    A medicine can have zero or more stocks and each stock is related to a particular medicine.
 
4.    A doctor can issue multiple prescriptions to a single patient and each prescription is issued by a single doctor. Each prescribed medication can be given by a single pharmacist.

5. Every patient will be one of the following – Student, Faculty, Dependents or Staff.

 
Potential queries:
      1.    Determining what are the contagious diseases currently prevailing in the campus.
2.    Finding medicines which are going to expire in a particular time frame.
3.    Finding the medical prescriptions of a particular patient sorted by recently added.
4.    Finding the pending prescriptions (for which the patient has not received the medicines).



