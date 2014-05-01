SELECT * FROM 'items'
WHERE parent_id IN(
	SELECT * FROM `items` 
	WHERE(
			(
				created > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 WEEK))  
				AND 
				name LIKE '%unchlezing%'
			)
			OR
			(
				created > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 3 WEEK))
				AND 
				name NOT LIKE '%unchlezing%'
			)
		)
		AND
		type = 'album'
)