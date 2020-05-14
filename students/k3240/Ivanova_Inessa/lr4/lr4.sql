select "MedicalFiles".patient_name, "MedicalFiles".patient_id, 
"MedicalFiles".patient_sex, "IllnesCases"."diagnosis_id(FK)"
from "ClinicDB"."MedicalFiles"
inner join "ClinicDB"."IllnesCases" on "MedicalFiles".patient_id = "IllnesCases"."patient_id(FK)"
where "diagnosis_id(FK)" = (
	select diagnosis_id from "ClinicDB"."Diagnoses"
	where diagnosis_name = 'Myopia') 
and patient_sex = 'F'
order by patient_id

select "Doctors".doc_name, "Doctors".doc_id from "ClinicDB"."Doctors" where "Doctors"."specialty_id(FK)" = (
	select specialty_id from "ClinicDB"."Specialties" where specialty_name = 'Eye doctor') 
order by doc_id

select * from "ClinicDB"."Consultations" where "payment_status" = true and "doc_id(FK)" = 102

select "patient_id(FK)", "doc_id(FK)", cons_date, "office_number(FK)" from "ClinicDB"."Consultations" where cons_date = '2020-03-18' and payment_status = true

select patient_id, patient_name, age(current_date, "MedicalFiles"."patient_BD") from "ClinicDB"."MedicalFiles"

select cons_date, "patient_id(FK)", (current_date - "Consultations".cons_date) from "ClinicDB"."Consultations"

select reverse(patient_name) as name from "ClinicDB"."MedicalFiles"

select cons_date, "doc_id(FK)", "patient_id(FK)" from "ClinicDB"."Consultations"
where "doc_id(FK)" = (select doc_id from "ClinicDB"."Doctors" where ("specialty_id(FK)" = (
	select specialty_id from "ClinicDB"."Specialties" where specialty_name = 'Dermatologist')))
			
select patient_name from "ClinicDB"."MedicalFiles" where patient_id = (select "patient_id(FK)" from "ClinicDB"."IllnesCases" where case_id = 328)

select avg(age(current_date, "MedicalFiles"."patient_BD")) from "ClinicDB"."MedicalFiles"

select count(*) from "ClinicDB"."Consultations" where (payment_status = true)

select count(*) from "ClinicDB"."Prices" group by service_price having service_price = '1000'

select * from "ClinicDB"."MedicalFiles" where patient_id = ANY (select "patient_id(FK)" from "ClinicDB"."Consultations" where cons_date = '2020-03-18')

select * from "ClinicDB"."Doctors" where doc_id = ANY (select "doc_id(FK)" from "ClinicDB"."Timetable" where date = '2020-03-18')

select "office_number(FK)" from "ClinicDB"."Timetable" intersect select office_number from "ClinicDB"."Offices" 

select patient_id from "ClinicDB"."MedicalFiles" except select "patient_id(FK)" from "ClinicDB"."Consultations" 

select "Doctors".doc_name, "Timetable"."office_number(FK)"
from "ClinicDB"."Doctors"
inner join "ClinicDB"."Timetable" on "Doctors".doc_id = "Timetable"."doc_id(FK)"
where date = '2020-03-18'

select "MedicalFiles".patient_id, "MedicalFiles".patient_name, 
"Consultations".cons_id, "Consultations"."doc_id(FK)"
from "ClinicDB"."MedicalFiles"
inner join "ClinicDB"."Consultations" on "MedicalFiles".patient_id = "Consultations"."patient_id(FK)"
where patient_condition = 'urgent'