select nom_oferta,
--regexp_split_to_array(nom_horario, '([0-9]{2})'),
nom_horario,
nom_periodo,
nom_professor,
nom_campus,
sum(total_matriculados) as alunos,
-- parte talvez melhor iterada pelo php
(select min(coalesce(qtd_max_assentos, qtd_assentos)) from udfsala.salas --pegar o codigo
where (qtd_max_assentos > sum(total_matriculados) OR qtd_assentos > sum(total_matriculados))
AND campus_sala = nom_campus AND cod_sala not in (select so.cod_sala from udfsala.ofertas so
where so.nom_horario = o.nom_campus
and so.nom_periodo = o.nom_campus
and so.nom_campus = o.nom_campus
)) as assentos
-- parte talvez melhor iterada pelo php
 from udfsala.ofertas o
where nom_oferta is not null
and nom_horario is not null
and nom_periodo is not null
and nom_professor is not null
and nom_campus is not null
and total_matriculados is not null
and cod_sala is null
and nom_horario not ilike '%X%'
and nom_horario not ilike '%B%'
group by (nom_oferta, nom_horario, nom_periodo, nom_professor, nom_campus)
order by nom_campus, nom_periodo, nom_horario, alunos, nom_oferta, nom_professor desc;

/**
cuidado para que não tenha um conjunto de nom_oferta, nom_horario, nom_periodo,nom_campus
diferente com a mesma sala e meio horarios na mesma sala de horarios duplos
*/

select coalesce(qtd_max_assentos, qtd_assentos) cap, cod_sala
from udfsala.salas where (qtd_max_assentos > 19 OR qtd_assentos > 19)
 and cod_sala not in (select cod_sala from udfsala.ofertas
                                where nom_horario = '6162'
                                and nom_periodo = 'NOITE'
                                and nom_campus = 'SEDE'
                                and cod_sala is not null)
                                and campus_sala = 'SEDE'
                                and nom_sala not ilike '%LAB%'
                                group by cod_sala
                                order by cap, nom_sala



-- select o1.nom_horario || o2.nom_horario,
-- o1.nom_periodo,
-- o1.nom_professor,
-- o1.nom_campus,
-- max(sum(total_matriculados)) as alunos,
--  from udfsala.ofertas o1
-- where nom_oferta is not null
-- and nom_horario is not null
-- and nom_periodo is not null
-- and nom_professor is not null
-- and nom_campus is not null
-- and total_matriculados is not null
-- --and cod_sala is null
-- and nom_horario not ilike '%X%'
-- and nom_horario not ilike '%B%'
-- group by (nom_horario, nom_periodo, nom_professor, nom_campus)
-- join udfsala.ofertas o2 on nom_horario