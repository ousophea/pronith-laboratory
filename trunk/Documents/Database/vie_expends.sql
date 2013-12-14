create view `vie_expends` as 
(select doc_com_title as `title`,
 doc_com_ammount as `amount`,
 doc_com_getPaid as `isPaid`,
 doc_com_dateCreated as `dateCreated`,
 doc_com_dateModified as `dateModified`,
 doc_com_status as `status`
from tbl_doctors_commissions)
UNION
(select oth_exp_title as `title`,
 oth_exp_amount as `amount`,
 oth_exp_isPaid as `isPaid`,
 oth_exp_dateCreated as `dateCreated`,
 oth_exp_dateModified as `dateModified`,
 oth_exp_status as `status`
from tbl_other_expends)