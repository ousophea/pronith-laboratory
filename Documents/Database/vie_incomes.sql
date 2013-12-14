CREATE VIEW `vie_incomes` AS 
SELECT pat_tes_dateCreated AS `dateCreated` , 
pat_tes_subTotal AS `subTotal` , 
(pat_tes_subTotal - ( pat_tes_subTotal * pat_tes_tax ) /100) AS `total_with_tax` , 
pat_tes_deposit AS `deposit` , 
pat_tes_owe AS `owe` , 
pat_tes_isPaid AS `isPaid`
FROM vie_patients_tests