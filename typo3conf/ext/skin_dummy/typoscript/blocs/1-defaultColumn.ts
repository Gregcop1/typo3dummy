lib.defaultColumn = CONTENT
lib.defaultColumn {
	table = tt_content
	select {
		orderBy = sorting
 		where = colPos = 0
	}
}