DROP VIEW IF EXISTS vie_doctors;
CREATE VIEW vie_doctors as
SELECT doctors . * , 
CONCAT(p_doctors.doc_firstName,' ',p_doctors.doc_lastName) as doc_ref_name, 
hospitals.hos_name,
phones.doc_pho_number
FROM `tbl_doctors` AS doctors
INNER JOIN `tbl_hospitals` AS hospitals ON doctors.doc_hos_id = hospitals.hos_id
LEFT JOIN `tbl_doctors_phones` AS phones ON doctors.doc_id = phones.doc_pho_doc_id
LEFT JOIN `tbl_doctors` AS p_doctors ON doctors.doc_reference = p_doctors.doc_id
GROUP BY doctors.doc_id