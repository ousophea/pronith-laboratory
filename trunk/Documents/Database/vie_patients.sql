DROP VIEW IF EXISTS vie_patients;
CREATE VIEW vie_patients AS
SELECT patients . * , 
CONCAT(doctors.doc_firstName,' ',doctors.doc_lastName) AS doc_name,
phones.pat_pho_number
FROM `tbl_patients` AS patients
LEFT JOIN `tbl_doctors` AS doctors ON patients.pat_doc_id = doctors.doc_id
LEFT JOIN `tbl_patients_phones` AS phones ON patients.pat_id = phones.pat_pho_pat_id
GROUP BY patients.pat_id