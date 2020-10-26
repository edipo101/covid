select `p`.`fuente` AS `fuente`,`p`.`organismo` AS `organismo`,`p`.`id_objeto` AS `id_objeto`,`o`.`descripcion` AS `descripcion`,
	count(0) AS `cant`,sum(`p`.`importe`) AS `subtotal`
from (`preventivo` `p` join `objeto` `o` on((`p`.`id_objeto` = `o`.`id_objeto`)))
group by `p`.`fuente`,`p`.`organismo`,`p`.`id_objeto`