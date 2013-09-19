create view vie_patients as
SELECT patients . * , 
doctors.doc_name
FROM `tbl_patients` AS patients
LEFT JOIN `tbl_doctors` AS doctors ON patients.pat_doc_id = doctors.doc_id