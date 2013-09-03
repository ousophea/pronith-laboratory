create view vie_doctors as
SELECT doctors . * , 
p_doctors.doc_name as doc_ref_name, 
hospitals.hos_name
FROM `tbl_doctors` AS doctors
INNER JOIN `tbl_hospitals` AS hospitals ON doctors.doc_hos_id = hospitals.hos_id
LEFT JOIN `tbl_doctors` AS p_doctors ON doctors.doc_reference = p_doctors.doc_id