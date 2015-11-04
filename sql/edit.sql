UPDATE 
	`layout` 

SET 
	`element` = :newName

WHERE 
	`id` = :id

LIMIT 1