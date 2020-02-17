<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReporteGrafico_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function meses(){
        $consulta = "select * from meses where id <= extract(month from (now())) order by id";
         $preguntas =  $this->db->query($consulta);
         $resultado=$preguntas->result();
        return $resultado;
    }
    
     public function departamentoActivos(){
        $consulta = "SELECT * FROM lugarnim where estado = 1 order by id";
         $preguntas =  $this->db->query($consulta);
         $resultado=$preguntas->result();
        return $resultado;
    }

    public function get_color() {
        
        $consulta = "SELECT descripcion color
                     FROM cat_color";
         //return  $this->db->query($consulta);
         $preguntas =  $this->db->query($consulta);
         $resultado=$preguntas->result();
        return $resultado;
       }
// **************************** BASE DE DATOS HISTORICO *********************************************************
// **************************************************************************************************************       
       
public function totales($gestion, $formulario){
       $consulta = " select * from fn_totales('$formulario', $gestion)";
     
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
}


// t4
  public function validadorPorMesPorDpto($departamento, $gestion, $mes){
      //***** VALIDADO
      $formulario = 'formm02';
     $consulta = "  with a as  (
                                select f.idlugarnim,  
                                        extract(month from(f.fechavalidacion)) mes, 
                                        f.codigovalidador, f.estado,count(f.id) cantidad
                                from " .$formulario. " f
                                where extract(year from(fechavalidacion))  = $gestion
                                and f.estado in (2)
                                and f.estadorevision is null
                                group by f.idlugarnim, extract(month from(f.fechavalidacion)), f.codigovalidador, f.estado
                        union all
                                select b.idlugar,
                                extract(month from(b.fecha)) mes,
                                u.usuario, 10 estado, count(b.id)
                                from bitacorarechazo b
                                left join usuario u on u.id = b.idusuario
                                where extract(year from b.fecha) = $gestion
                                and b.id" .$formulario. " >0
                                and b.estado = 0
                                group by b.idlugar,extract(month from(b.fecha)), u.usuario
                    )
                        select * from a
			left join (
				select id iddepartamento, descripcion departamento   
				from lugarnim
				WHERE ESTADO = 1
			    ) b
			on b.iddepartamento = a.idlugarnim
			left join  (
				select id mes, nombre nombremes  from meses
			)c on c.mes = a.mes
			left join  (
                                select e.descripcion descripcionestado, e.id idestado  from estadoformulario e where e.id in (2,10)
			)d on d.idestado = a.estado
                    where a.idlugarnim = $departamento
                    and   a.mes        = $mes                                    
                    order by 1,2,3,d.descripcionestado";
     // echo 'aaa '.$consulta;
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
 }
 // public function validadorPorGestionHoy($formulario ){
  public function validadorParaGerenciaHoy($formulario ){
      // DPTO-USUARIO, ESTADO  mm
       // ********* VALIDADO FF
       
     $consulta = "with e as  (
			select f.idlugarnim,  f.codigovalidador, f.estado,count(f.id) cantidad
                        from " .$formulario. "  f
                        where fechavalidacion::date = now()::date 
                        and f.estado in (2)
                        and f.estadorevision is null
                        group by f.idlugarnim, f.codigovalidador, f.estado
                union all
			select b.idlugar, u.usuario, 10 estado, count(b.id)
			from bitacorarechazo b
			left join usuario u on u.id = b.idusuario
                        where b.fecha::date = now()::date 
			and b.id" .$formulario. "  >0
                        and b.estado = 0
			group by b.idlugar, u.usuario
         )
         select idlugarnim, case when codigovalidador is null then 'SN' else codigovalidador end codigovalidador,
                estado, cantidad, iddepartamento,
                case when iddepartamento is null then 'SL' else b.departamento END,
                descripcionestado, idestado,
                case when codigovalidador is null 
		then CASE WHEN b.departamento is null then 
				'SL - SN'
			  else 
				b.departamento || ' - SN'
			  end
		else
			CASE WHEN b.departamento is null then 
				'SL - '|| codigovalidador
			  else 
				 b.departamento||' - '||a.codigovalidador
			  end
		end codigovalidador2
                from
                        (
                                select * from e
			union 
				select idlugarnim, codigovalidador , 777 estado, sum(cantidad)
				from e
				group by idlugarnim, codigovalidador
				--order by 1,2
			union
				select lugar, usuario, 777, 0
				from e 
				 full join   usuario u on e.codigovalidador = u.usuario
				 where e.codigovalidador is null
				 and u.activo  = 1
				 and u.idrol   = 6
				 and u." .$formulario. "  = 1
                        ) a
			left join (
				select id iddepartamento, descripcion departamento   
				from lugarnim
				WHERE ESTADO = 1
			    ) b
			on b.iddepartamento = a.idlugarnim
			left join  (
                                select e.descripcion descripcionestado, e.id idestado  from estadoformulario e where e.id in (2,10)
                                UNION ALL
                                (select 'TOTAL' descripcionestado, 777 estado)
			)d on d.idestado = a.estado
                       -- where a.cantidad >0
                order by 1,2,d.descripcionestado";
     // ECHO 'ultimo: '.$consulta;
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
 }
 // t2
   public function validadorPorGestion($gestion,$formulario ){
      // DPTO-USUARIO, ESTADO  mm
       // ********* VALIDADO FF
       
     $consulta = "with e as  (
			select f.idlugarnim,  f.codigovalidador, f.estado,count(f.id) cantidad
                        from " .$formulario. "  f
                        where extract(year from(fechavalidacion))  = $gestion
                        and f.estado in (2)
                        and f.estadorevision is null
                        group by f.idlugarnim, f.codigovalidador, f.estado
                union all
			select b.idlugar, u.usuario, 10 estado, count(b.id)
			from bitacorarechazo b
			left join usuario u on u.id = b.idusuario
			where extract(year from b.fecha) = $gestion
			and b.id" .$formulario. "  >0
                        and b.estado = 0
			group by b.idlugar, u.usuario
         )
         select idlugarnim, case when codigovalidador is null then 'SN' else codigovalidador end codigovalidador,
                estado, cantidad, iddepartamento,
                case when iddepartamento is null then 'SL' else b.departamento END,
                descripcionestado, idestado,
                case when codigovalidador is null 
		then CASE WHEN b.departamento is null then 
				'SL - SN'
			  else 
				b.departamento || ' - SN'
			  end
		else
			CASE WHEN b.departamento is null then 
				'SL - '|| codigovalidador
			  else 
				 b.departamento||' - '||a.codigovalidador
			  end
		end codigovalidador2
                from
                        (
                                select * from e
			union 
				select idlugarnim, codigovalidador , 777 estado, sum(cantidad)
				from e
				group by idlugarnim, codigovalidador
				--order by 1,2
			union
				select lugar, usuario, 777, 0
				from e 
				 full join   usuario u on e.codigovalidador = u.usuario
				 where e.codigovalidador is null
				 and u.activo  = 1
				 and u.idrol   = 6
				 and u." .$formulario. "  = 1
                        ) a
			left join (
				select id iddepartamento, descripcion departamento   
				from lugarnim
				WHERE ESTADO = 1
			    ) b
			on b.iddepartamento = a.idlugarnim
			left join  (
                                select e.descripcion descripcionestado, e.id idestado  from estadoformulario e where e.id in (2,10)
                                UNION ALL
                                (select 'TOTAL' descripcionestado, 777 estado)
			)d on d.idestado = a.estado
                order by 1,2,d.descripcionestado";
     // ECHO 'ultimo: '.$consulta;
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
 }
 public function validadorPorDptoHoy($departamento,$formulario){
      // DPTO , USUARIO, ESTADO   mm
     // VALIDADO FF
     $consulta = "  
      with e as  (
			select f.idlugarnim, f.codigovalidador, f.estado,count(f.id) cantidad
                        from " .$formulario. " f
                        where fechavalidacion::date = now()::date - CAST('2 days' AS INTERVAL)
                        and   f.estado in (2)
                        and   f.estadorevision is null
                        group by f.idlugarnim, f.codigovalidador, f.estado
                union all
			select b.idlugar, u.usuario, 10 estado, count(b.id)
			from bitacorarechazo b
			left join usuario u on u.id = b.idusuario
                        where b.fecha::date = now()::date - CAST('2 days' AS INTERVAL)
			and   b.id" .$formulario. " >0
                        and b.estado = 0
			group by b.idlugar, u.usuario
     )
            select * 
                    from
                    (
				select * from e
			union 
				select idlugarnim, codigovalidador , 777 estado, sum(cantidad)
				from e
				group by idlugarnim, codigovalidador
			union
				select lugar, usuario, 777, 0
				from e 
				 full join   usuario u on e.codigovalidador = u.usuario
				 where e.codigovalidador is null
				 and u.activo  = 1
				 and u.idrol   = 6
				 and u." .$formulario. " = 1
                    ) a
			left join (
				select id iddepartamento, descripcion departamento   
				from lugarnim
				WHERE ESTADO = 1
			    ) b
			on b.iddepartamento = a.idlugarnim
			left join  (

                                select e.descripcion descripcionestado, e.id idestado  from estadoformulario e
                                where e.id in (2,10)
                                 UNION ALL
                                (select 'TOTAL' descripcionestado, 777 estado)
                               
			)d on d.idestado = a.estado
                where a.idlugarnim = $departamento 
                order by 1,2,d.descripcionestado";
      //echo $consulta; 
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
 }
// similar al t2
 public function validadorPorDpto($departamento,$gestion, $formulario){
      // DPTO , USUARIO, ESTADO   mm
     // VALIDADO FF
     $consulta = "  
      with e as  (
			select f.idlugarnim,  
                                f.codigovalidador, f.estado,count(f.id) cantidad
                        from " .$formulario. " f
                        where extract(year from(fechavalidacion))  = $gestion
                        and f.estado in (2)
                        and f.estadorevision is null
                        group by f.idlugarnim, f.codigovalidador, f.estado
                union all
			select b.idlugar, u.usuario, 10 estado, count(b.id)
			from bitacorarechazo b
			left join usuario u on u.id = b.idusuario
			where extract(year from b.fecha) = $gestion
			and b.id" .$formulario. " >0
                        and b.estado = 0
			group by b.idlugar, u.usuario
     )
            select * 
                    from
                    (
				select * from e
			union 
				select idlugarnim, codigovalidador , 777 estado, sum(cantidad)
				from e
				group by idlugarnim, codigovalidador
			union
				select lugar, usuario, 777, 0
				from e 
				 full join   usuario u on e.codigovalidador = u.usuario
				 where e.codigovalidador is null
				 and u.activo  = 1
				 and u.idrol   = 6
				 and u." .$formulario. " = 1
                    ) a
			left join (
				select id iddepartamento, descripcion departamento   
				from lugarnim
				WHERE ESTADO = 1
			    ) b
			on b.iddepartamento = a.idlugarnim
			left join  (

                                select e.descripcion descripcionestado, e.id idestado  from estadoformulario e
                                where e.id in (2,10)
                                 UNION ALL
                                (select 'TOTAL' descripcionestado, 777 estado)
                               
			)d on d.idestado = a.estado
                where a.idlugarnim = $departamento 
                order by 1,2,d.descripcionestado";
     // echo $consulta; 
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
 }
 
 public function estadoDptoMes($departamento) {
      // ESTADO 0 y 1
     // 
      $formulario = 'M-02';
      $consulta = "select a.departamento, a.numero1, replace (b.estado, ' ','_') estado, b.numero2, case when  c.cantidad is null then 0 else c.cantidad end, mes
                      from (
                                select id numero1, descripcion departamento, 'a'::text u1  
				from lugarnim
                                order by 1
                                ) a
                       left join (
                                select distinct e.descripcion estado, e.id, 'a' u2,
                                row_number() over (order by e.descripcion) as numero2
                                from formm02 f
                                left join estadoformulario e on e.id = f.estado
                                where e.id in (0,1)
                                group by e.descripcion, e.id
                        )
                        b on b.u2= a.u1
                        left join (

				select f.idlugarnim, 
				 f.estado , count(f.id) cantidad , 
				extract(month from(fecharegistro)) mes
                                from formm02 f
                                where f.estado in (0,1)
				and f.idlugarnim is not null
				and f.idlugarnim=$departamento
                                and f.estadorevision is null
                                group by f.estado , f.idlugarnim, extract(month from(fecharegistro))
                                order by f.idlugarnim, f.estado
                        ) c on c.idlugarnim = a.numero1 and c.estado = b.id
                        where a.numero1 = $departamento
                        order by c.mes,a.departamento, b.estado";
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
  }
  public function estadoPorMesPorDptoOnLine($departamento, $gestion, $formulario){
      // ESTADOS 77 REGISTRADOS
      // ESTADOS 1 PENDIENTE
      // ESTADOS 2 VALIDADO
      // ESTADOS 10 RECHAZADO
      
      $consulta = "
	select a.departamento, a.iddepartamento, replace (b.estado, ' ','_') estado, b.idestado, case when  c.cantidad is null then 0 else c.cantidad end, d.mes, d.nombremes
                      from (
                                select id iddepartamento, descripcion departamento, 'a'::text u1  
				from lugarnim
                                WHERE ESTADO = 1
                            ) a
                      left join  (
                                select e.descripcion estado, e.id idestado, 'a'::text u2 from estadoformulario e
                                where e.id in (2,10,1)
                                union all
                                ( select 'REGISTRADO' estado, 77 idestado,  'a'::text u2 )
			)b on b.u2= a.u1
			left join  (
				select id mes, nombre nombremes, 'a'::text u3 from meses
			)d on d.u3= b.u2
                        left join  (

                                        (
                                            select f.idlugarnim,  count(f.id) cantidad , extract(month from(f.fechavalidacion)) mes, f.estado
                                            from " .$formulario. " f
                                            WHERE extract(year from(f.fechavalidacion)) = $gestion
                                            --and f.fecharegistro < ('01/' ||extract(month from(f.fechavalidacion)) || '/' ||extract(year from(f.fechavalidacion)))::date
                                            and f.estado in (2,10)
                                            --and f.idlugarnim is not null
                                            and f.estadorevision is null
                                            group by f.idlugarnim, extract(month from(f.fechavalidacion)), f.estado
                                            order by mes, f.idlugarnim,f.estado


                                        ) UNION ALL (
      
                                            -- TODOS LOS ESTADOS PARA EL nuevo estado REGISTRADO
                                            select f.idlugarnim, count(f.id) cantidad, extract(month from(f.fecharegistro)) mes, 77 estado
                                            from " .$formulario. " f
                                            where extract(year from(f.fecharegistro)) = $gestion
                                            -- and f.idlugarnim is not null
                                            and f.estadorevision is null
                                            group by f.idlugarnim, extract(month from(f.fecharegistro))
                                            -- order by mes, f.idlugarnim, f.estado
      
                                        ) UNION ALL (

                                        select f.idlugarnim, count(f.id) cantidad, extract(month from(f.fecharegistro)) mes, f.estado
                                        from " .$formulario. " f
                                        where extract(year from(f.fecharegistro)) = $gestion
                                        and f.estado in (1)
                                        -- and f.idlugarnim is not null
                                        and f.estadorevision is null
                                        group by f.idlugarnim, extract(month from(f.fecharegistro)), f.estado
                                        )

                        ) c on c.idlugarnim = a.iddepartamento and c.estado = b.idestado and c.mes = d.mes
	where a.iddepartamento = $departamento
	order by 6,1,4";
      
      
        $query = $this->db->query($consulta);
        $preguntas=$query->result();
        return $preguntas;
    }
  
  // t3
 public function estadoPorMesPorDpto($departamento, $gestion, $formulario){
      // *** TABLA HISTORICO ********** ff
      //  ESTADOS 77 REGISTRADOS
      // ESTADOS 1 PENDIENTE
      // ESTADOS 2 VALIDADO
      // ESTADOS 10 RECHAZADO
      //$formulario = 'M-02';
      $consulta = "
          with e as  (
                            select f.idlugarnim,  count(f.id) cantidad , idmes mes, f.estado
                            from historico_m02_m03 f
                            WHERE  f.gestion = $gestion
                            and f.formulario = '$formulario'
                            and extract(year from(fechavalidacion))  = f.gestion
                            and extract(month from(fechavalidacion)) = f.idmes
                            --and f.fecharegistro < ('1/'||extract(month from(fechavalidacion))||'/'||extract(year from(fechavalidacion)))::date
                            and f.estado in (2,10)
                            --and f.idlugarnim is not null
                            --and f.estadorevision is null
                            group by f.idlugarnim, idmes, f.estado
                            --order by mes, f.idlugarnim,f.estado

                                          UNION ALL 

                            select f.idlugarnim, count(f.id) cantidad, idmes mes, f.estado
                            from historico_m02_m03 f
                            WHERE  f.gestion  = $gestion
                            and f.formulario = '$formulario'
                            and extract(year from(fecharegistro))  = f.gestion
                            and extract(month from(fecharegistro)) = f.idmes
                            and f.estado in (1)
                            -- and f.idlugarnim is not null
                            -- and f.estadorevision is null
                            group by f.idlugarnim,idmes, f.estado
                            --order by mes, f.idlugarnim,f.estado
     
                                     UNION ALL

                            select f.idlugarnim, count(f.id) cantidad, idmes mes, 77 estado
                            from historico_m02_m03 f
                            WHERE  f.gestion  = $gestion
                            and f.formulario = '$formulario'
                            and extract(year from(fecharegistro))  = f.gestion
                            and extract(month from(fecharegistro)) = f.idmes
                            and f.estado not in (0,5)
                            -- and f.idlugarnim is not null
                            -- and f.estadorevision is null
                            group by f.idlugarnim,idmes
                                        )
	select a.departamento, a.iddepartamento, replace (b.estado, ' ','_') estado, b.idestado, case when  c.cantidad is null then 0 else c.cantidad end, d.mes, d.nombremes
                      from (
                                select id iddepartamento, descripcion departamento, 'a'::text u1  
				from lugarnim
                                WHERE ESTADO = 1
                            ) a
                      left join  (
                                select e.descripcion estado, e.id idestado, 'a'::text u2 from estadoformulario e
                                where e.id in (2,10,1)
                                union all
                                ( select 'REGISTRADO' estado, 77 idestado,  'a'::text u2 )
			)b on b.u2= a.u1
			left join  (
				select id mes, nombre nombremes, 'a'::text u3 from meses
			)d on d.u3= b.u2
                        left join  (
                                        select * from e
                        ) c on c.idlugarnim = a.iddepartamento and c.estado = b.idestado and c.mes = d.mes
	where a.iddepartamento = $departamento
	order by 2,6,4";
      
      
        $query = $this->db->query($consulta);
        $preguntas=$query->result();
        return $preguntas;
    }
  // T1 ES IGUAL A datosParaCuadroNacional TOTALES POR DPTO
 public function estadoFormm02($gestion)
    {
      $formulario = 'M-02';
       
 // *********** TABLA HISTORICO *****************      VERIFICADO F
    
        $consulta = "select a.departamento, a.iddepartamento, replace (b.estado, ' ','_') estado, b.idestado, case when  c.cantidad is null then 0 else c.cantidad end --, d.mes, d.nombremes
                      from (
                                select id iddepartamento, descripcion departamento, 'a'::text u1  
				from lugarnim
                                WHERE ESTADO =1
                            ) a

                      left join  (

                                select e.descripcion estado, e.id idestado, 'a'::text u2 from estadoformulario e
                                where e.id in (2,10,1)
                                union all
                                ( select 'REGISTRADO' estado, 77 idestado,  'a'::text u2 )

			)b on b.u2= a.u1

                        left join  (
                                        (
                                            select f.idlugarnim,  count(f.id) cantidad , f.estado
                                            from historico_m02_m03 f
                                            WHERE f.gestion = $gestion
					    and f.formulario = '$formulario'
                                            and extract(year from(fechavalidacion))  = f.gestion
                                            and extract(month from(fechavalidacion)) = f.idmes
                                            and   f.estado in (2,10)
                                            --and f.idlugarnim is not null
                                            -- and f.estadorevision is null
                                            group by f.idlugarnim, f.estado
                                            --order by f.idlugarnim,f.estado


                                        ) UNION ALL (
      
                                            -- TODOS LOS ESTADOS PARA EL nuevo estado REGISTRADO
                                            select f.idlugarnim, count(f.id) cantidad, 77 estado
                                            from historico_m02_m03 f
                                            where f.gestion     = $gestion
					       and f.formulario = '$formulario'
                                            and extract(year from(fecharegistro))  = f.gestion
                                            and extract(month from(fecharegistro)) = f.idmes
                                            -- and f.idlugarnim is not null
                                            -- and f.estadorevision is null
                                            group by f.idlugarnim --, extract(month from(f.fecharegistro))
                                            -- order by mes, f.idlugarnim, f.estado
      
                                        ) UNION ALL (

                                        select f.idlugarnim, count(f.id) cantidad, f.estado
                                        from historico_m02_m03 f
                                        where f.gestion  = $gestion
                                        and f.formulario = '$formulario'
                                        and extract(year from(fecharegistro))  = f.gestion
                                        and extract(month from(fecharegistro)) = f.idmes
                                        and f.estado in (1)
                                        -- and f.idlugarnim is not null
                                        -- and f.estadorevision is null
                                        group by f.idlugarnim, f.estado 
                                        )

                        ) c on c.idlugarnim = a.iddepartamento and c.estado = b.idestado
		order by 2,3";
        $query = $this->db->query($consulta);//, Array());
        //return $query->result_array();
        $preguntas=$query->result();
        return $preguntas;
    }
    
    public function datosParaCuadroOnLine($departamento, $gestion, $formulario){
        $consulta = "select a.departamento,oo.idlugarnim, d.nombremes, b.estado, oo.cantidad
                    from (

        (
                        select f.idlugarnim, f.estado , count(f.estado) cantidad, extract(month from(fechavalidacion)) mes
                        from " . $formulario . " f
                        where extract(year from(fechavalidacion)) = $gestion
                        -- and f.fecharegistro < ('01/' ||extract(month from(f.fechavalidacion)) || '/' ||extract(year from(f.fechavalidacion)))::date
                        AND f.estado in (2,10)
                        --and f.idlugarnim is not null
                        and f.estadorevision is null
                        and f.idlugarnim = $departamento
                       group by f.estado , f.idlugarnim, extract(month from(fechavalidacion))
                        -- order by mes, f.idlugarnim, f.estado
        ) UNION ALL (
                        -- TODOS LOS ESTADOS PARA LOS REGISTRADOS
                        select f.idlugarnim, 77 estado , count(f.estado) cantidad, extract(month from(fecharegistro)) mes
                        from " . $formulario . " f
                        where extract(year from(fecharegistro)) = $gestion
                        --AND f.idlugarnim is not null
                        and f.estadorevision is null
                        and f.idlugarnim = $departamento
                        group by f.idlugarnim, extract(month from(fecharegistro))
                        -- order by mes, f.idlugarnim, f.estado
        ) UNION ALL (

                        select f.idlugarnim, f.estado , count(f.estado) cantidad, extract(month from(fecharegistro)) mes
                        from " . $formulario . " f
                        where extract(year from(fecharegistro)) = $gestion
                        AND f.estado in (1)
                        --and f.idlugarnim is not null
                        and f.estadorevision is null
                        and f.idlugarnim = $departamento
                        group by f.estado , f.idlugarnim, extract(month from(fecharegistro))
                        --order by mes, f.idlugarnim, f.estado
        )
                    ) oo
                    left join (
                            select id iddepartamento, descripcion departamento
                            from lugarnim
                            -- order by 1

                    ) a on a.iddepartamento = oo.idlugarnim

                    left join  (
                            select e.descripcion estado, e.id idestado
                            from estadoformulario e
                            where e.id in (2,10,1)
                            union all
                            ( select 'REGISTRADO' estado, 77 idestado )

                    )b on b.idestado = oo.estado

                    left join  (
                            select id mes, nombre nombremes from meses
                    )d on d.mes = oo.mes

                    order by 2,3,4";
       // ECHO $consulta; exit();
        
        $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
       
       
    }
    
    // t3 igual estadoPorMesPorDpto 
    // para datos tabulares, sin 0
    public function datosParaCuadro($departamento, $gestion, $formulario){
       // $formulario = 'M-02';
        // **** base historica **** verificado f
        $consulta = "with e as (
  (
                        select f.idlugarnim, f.estado , count(f.id) cantidad, extract(month from(fechavalidacion)) mes
                        from historico_m02_m03 f
                        where f.gestion  = $gestion
			and f.formulario = '$formulario'
                        and extract(year from(fechavalidacion))  = f.gestion
			and extract(month from(fechavalidacion)) = f.idmes
                        -- and f.fecharegistro < ('01/' ||extract(month from(f.fechavalidacion)) || '/' ||extract(year from(f.fechavalidacion)))::date
                        AND f.estado in (2,10)
                        -- and f.idlugarnim is not null
                        -- and f.estadorevision is null
                        and f.idlugarnim = $departamento
                        group by f.estado , f.idlugarnim, extract(month from(fechavalidacion))
                        -- order by mes, f.idlugarnim, f.estado
        ) UNION ALL (

                        select f.idlugarnim, f.estado , count(f.id) cantidad, extract(month from(fecharegistro)) mes
                        from historico_m02_m03 f
                        where f.gestion  = $gestion
			and f.formulario = '$formulario'
                        and extract(year from(fecharegistro))  = f.gestion
			and extract(month from(fecharegistro)) = f.idmes
                        AND f.estado in (1)
                        and f.idlugarnim is not null
                        -- and f.estadorevision is null
                        and f.idlugarnim = $departamento
                        group by f.estado , f.idlugarnim, extract(month from(fecharegistro))
                        --order by mes, f.idlugarnim, f.estado
        ) UNION ALL (

                        select f.idlugarnim, 77 estado , count(f.id) cantidad, extract(month from(fecharegistro)) mes
                        from historico_m02_m03 f
                        where f.gestion  = $gestion
			and f.formulario = '$formulario'
                        and extract(year from(fecharegistro))  = f.gestion
			and extract(month from(fecharegistro)) = f.idmes
                        AND f.estado not in (0,5)
                        and f.idlugarnim is not null
                        -- and f.estadorevision is null
                        and f.idlugarnim = $departamento
                        group by f.idlugarnim, extract(month from(fecharegistro))
                        --order by mes, f.idlugarnim, f.estado
        )
)
	select a.departamento,oo.idlugarnim, d.nombremes, b.estado, oo.cantidad
                    from (
                                select * from e
                    ) oo
                    left join (
                            select id iddepartamento, descripcion departamento
                            from lugarnim
                            -- order by 1
                    ) a on a.iddepartamento = oo.idlugarnim
                    left join  (
                            select e.descripcion estado, e.id idestado
                            from estadoformulario e
                            where e.id in (2,10,1)
                            union all
                            ( select 'REGISTRADO' estado, 77 idestado )
                    )b on b.idestado = oo.estado
                    left join  (
                            select id mes, nombre nombremes from meses
                    )d on d.mes = oo.mes
                    order by 2,3,4";
       // ECHO $consulta; exit();
        
        $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
    }

public function datosCuadroNacionalOnLineDpto($gestion, $formulario, $dpto){
        $consulta = "select a.departamento, a.iddepartamento, replace (b.estado, ' ','_') estado, b.idestado, case when  c.cantidad is null then 0 else c.cantidad end --, d.mes, d.nombremes
                      from (
                                select id iddepartamento, descripcion departamento, 'a'::text u1  
				from lugarnim
				WHERE ESTADO =1
                            ) a
                      left join  (
                                select e.descripcion estado, e.id idestado, 'a'::text u2 from estadoformulario e
                                where e.id in (2,10,1)
                                union all
                                ( select 'REGISTRADO' estado, 77 idestado,  'a'::text u2 )

			)b on b.u2= a.u1
                        left join  (
                                        (
                                            select f.idlugarnim,  count(f.id) cantidad , f.estado
                                            from " .$formulario." f
                                            WHERE extract(year from(f.fechavalidacion)) = $gestion
                                            --and f.fecharegistro < ('01/' ||extract(month from(f.fechavalidacion)) || '/' ||extract(year from(f.fechavalidacion)))::date
                                            and f.estado in (2,10)
                                            --and f.idlugarnim is not null
                                            and f.estadorevision is null
                                            group by f.idlugarnim, f.estado
                                          
                                        ) UNION ALL  (

                                        select f.idlugarnim, count(f.id) cantidad, f.estado
                                        from " .$formulario." f
                                        where extract(year from(f.fecharegistro)) = $gestion
                                        and f.estado in (1)
                                        -- and f.idlugarnim is not null
                                        and f.estadorevision is null
                                        group by f.idlugarnim, f.estado
    
                                        ) UNION ALL  (
    
                                        select f.idlugarnim, count(f.id) cantidad,  77 estado
					from " .$formulario." f
					WHERE  extract(year from(f.fecharegistro)) = $gestion
					and f.estado not in (0,5)
					-- and f.idlugarnim is not null
					and f.estadorevision is null
					group by f.idlugarnim
                                    )
                        ) c on c.idlugarnim = a.iddepartamento and c.estado = b.idestado
        where a.iddepartamento = $dpto
	order by 2,idestado";
        //ECHO $consulta; exit();
        
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
    }    
    // acumulado en linea
  public function datosParaCuadroNacionalOnLine($gestion, $formulario){
        $consulta = "
               with e as ( (
                                select f.idlugarnim,  count(f.id) cantidad , f.estado
                                from " .$formulario." f
                                WHERE extract(year from(f.fechavalidacion)) = $gestion
                                --and f.fecharegistro < ('01/' ||extract(month from(f.fechavalidacion)) || '/' ||extract(year from(f.fechavalidacion)))::date
                                and f.estado in (2,10)
                                --and f.idlugarnim is not null
                                and f.estadorevision is null
                                group by f.idlugarnim, f.estado

                            )  UNION ALL (

                                select f.idlugarnim, count(f.id) cantidad, f.estado
                                from " .$formulario." f
                                where extract(year from(f.fecharegistro)) = $gestion
                                and f.estado in (1)
                                -- and f.idlugarnim is not null
                                and f.estadorevision is null
                                group by f.idlugarnim, f.estado
      
                            ) union all (

				select f.idlugarnim,  count(f.id) cantidad , 77 estado
                                from  " .$formulario." f
                                WHERE extract(year from(f.fecharegistro)) =  $gestion
                                --and f.fecharegistro < ('01/' ||extract(month from(f.fechavalidacion)) || '/' ||extract(year from(f.fechavalidacion)))::date
                                and f.estado not in (0,5)
                                --and f.idlugarnim is not null
                                and f.estadorevision is null
                                group by f.idlugarnim 

                            )
                    )
                select a.departamento, a.iddepartamento, replace (b.estado, ' ','_') estado, b.idestado, case when  c.cantidad is null then 0 else c.cantidad end --, d.mes, d.nombremes
                        from (
                                select id iddepartamento, descripcion departamento, 'a'::text u1  
				from lugarnim
				WHERE ESTADO =1
                            ) a
                        left join  (
                                select e.descripcion estado, e.id idestado, 'a'::text u2 from estadoformulario e
                                where e.id in (2,10,1)
                                union all
                                ( select 'REGISTRADO' estado, 77 idestado,  'a'::text u2 )
			)b on b.u2= a.u1
                        left join  (
                                        select * from e
                        ) c on c.idlugarnim = a.iddepartamento and c.estado = b.idestado
	order by iddepartamento,idestado";
        //ECHO $consulta; exit();
        
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
       
       
    }
   // cuadro de totales DPTO ESTADO CANTIDAD  T1 historico
   public function datosParaCuadroNacional($gestion, $formulario){
       // ***********  TABLA HISTORICO ********************* validacion ff
       //$formulario = 'M-02';
       $consulta   = " select a.departamento, a.iddepartamento, replace (b.estado, ' ','_') estado, b.idestado, case when  c.cantidad is null then 0 else c.cantidad end --, d.mes, d.nombremes
                      from (
                                select id iddepartamento, descripcion departamento, 'a'::text u1  
				from lugarnim
				WHERE ESTADO =1
                            ) a

                      left join  (

                                select e.descripcion estado, e.id idestado, 'a'::text u2 from estadoformulario e
                                where e.id in (2,10,1)
                                union all
                                ( select 'REGISTRADO' estado, 77 idestado,  'a'::text u2 )

			)b on b.u2= a.u1


                        left join  (

                                        (
                                            select f.idlugarnim,  count(f.id) cantidad , f.estado
                                            from historico_m02_m03 f
                                             where f.gestion  = $gestion
                                            and f.formulario = '$formulario'
                                            and extract(year from(fechavalidacion))  = f.gestion
                                            and extract(month from(fechavalidacion)) = f.idmes
                                            and f.estado in (2,10)
                                            --and f.idlugarnim is not null
                                            -- and f.estadorevision is null
                                            group by f.idlugarnim, f.estado
                                            order by f.idlugarnim,f.estado


                                        ) UNION ALL (
      
                                            -- TODOS LOS ESTADOS PARA EL nuevo estado REGISTRADO
                                            select f.idlugarnim, count(f.id) cantidad, 77 estado
                                            from historico_m02_m03 f
                                            where f.gestion  = $gestion
                                            and f.formulario = '$formulario'
                                            and extract(year from(fecharegistro))  = f.gestion
                                            and extract(month from(fecharegistro)) = f.idmes
                                            -- and f.idlugarnim is not null
                                            -- and f.estadorevision is null
                                            group by f.idlugarnim --, extract(month from(f.fecharegistro))
                                            -- order by mes, f.idlugarnim, f.estado
      
                                        ) UNION ALL (

                                        select f.idlugarnim, count(f.id) cantidad, f.estado --, extract(month from(f.fecharegistro)) MES
                                        from historico_m02_m03 f
                                         where f.gestion  = $gestion   
                                         and f.formulario = '$formulario'
                                        and extract(year from(fecharegistro))  = f.gestion
                                        and extract(month from(fecharegistro)) = f.idmes
                                        and f.estado in (1)
                                        -- and f.idlugarnim is not null
                                        -- and f.estadorevision is null
                                        group by f.idlugarnim, f.estado --, extract(month from(f.fecharegistro))
                                        ORDER BY IDLUGARNIM --, MES
                                        )

                        ) c on c.idlugarnim = a.iddepartamento and c.estado = b.idestado
	order by 2,3";
       // ECHO $consulta; exit();
       $query = $this->db->query($consulta);
       $preguntas=$query->result();
       return $preguntas;
    }
    
}

?>