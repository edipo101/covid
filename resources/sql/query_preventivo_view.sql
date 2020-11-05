select *, ubicacion_men.ubicacion as ubimen, ubicacion_dir.ubicacion as ubidir,
       if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent              
from preventivo
LEFT JOIN ubicacion_men on id_ubimen = ubicacion_men.id_ubicacion
LEFT JOIN ubicacion_dir on id_ubidir = ubicacion_dir.id_ubicacion
LEFT JOIN secretaria on preventivo.id_secretaria = secretaria.id_secretaria
LEFT JOIN estado on preventivo.id_estado = estado.id_estado