SELECT 
	`id_layout`,
	`element`,
	`content`

FROM 
	`layout`

INNER JOIN `project`
-- on `project`.`id_project` = `layout`.`id_project`
USING ( `id_project` )

WHERE
	`id_project` = :projectID
AND
	`user` = :userID

ORDER BY 
	`order` ASC
