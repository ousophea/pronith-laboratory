CREATE VIEW `vie_ills_items` 
AS select `ills_groups`.`ill_gro_id` AS `ill_gro_id`,
`ills_groups`.`ill_gro_name` AS `ill_gro_name`,
`ills_groups`.`ill_gro_status` AS `ill_gro_status`,
`ills`.`ill_id` AS `ill_id`,
`ills`.`ill_name` AS `ill_name`,
`ills`.`ill_status` AS `ill_status`,
`ills_items`.`ill_ite_id` AS `ill_ite_id`,
`ills_items`.`ill_ite_ill_id` AS `ill_ite_ill_id`,
`ills_items`.`ill_ite_name` AS `ill_ite_name`,
`ills_items`.`ill_ite_description` AS `ill_ite_description`,
`ills_items`.`ill_ite_dimention` AS `ill_ite_dimention`,
`ills_items`.`ill_ite_value_male` AS `ill_ite_value_male`,
`ills_items`.`ill_ite_value_female` AS `ill_ite_value_female`,
`ills_items`.`ill_ite_dateCreated` AS `ill_ite_dateCreated`,
`ills_items`.`ill_ite_dateModified` AS `ill_ite_dateModified`,
`ills_items`.`ill_ite_status` AS `ill_ite_status` 
from ((`tbl_ills_items` `ills_items` 
join `tbl_ills` `ills` on((`ills_items`.`ill_ite_ill_id` = `ills`.`ill_id`))) 
join `tbl_ills_groups` `ills_groups` on((`ills`.`ill_ill_gro_id` = `ills_groups`.`ill_gro_id`)));