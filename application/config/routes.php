<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_inicio';

$route['C_buscarDeposito/pagina/(:num)'] = 'C_buscarDeposito/index/$1';
$route['C_buscarDeposito'] = "C_buscarDeposito";

$route['C_buscarDepositoM01/pagina/(:num)'] = 'C_buscarDepositoM01/index/$1';
$route['C_buscarDepositoM01'] = "C_buscarDepositoM01";

$route['C_buscarDepositoM02/pagina/(:num)'] = 'C_buscarDepositoM02/index/$1';
$route['C_buscarDepositoM02'] = "C_buscarDepositoM02";

$route['C_buscarDepositoM03/pagina/(:num)'] = 'C_buscarDepositoM03/index/$1';
$route['C_buscarDepositoM03'] = "C_buscarDepositoM03";

$route['C_relacionadorM03M02/pagina/(:num)'] = 'C_relacionadorM03M02/index/$1';
$route['C_relacionadorM03M02'] = "C_relacionadorM03M02";

$route['C_declaradoDetalle3/pagina/(:num)'] = 'C_declaradoDetalle3/index/$1';
$route['C_declaradoDetalle3'] = "C_declaradoDetalle3";

$route['C_noReliquidadoReliquidacion/pagina/(:num)'] = 'C_noReliquidadoReliquidacion/index/$1';
$route['C_noReliquidadoReliquidacion'] = "C_noReliquidadoReliquidacion";

$route['C_reliquidadoReliquidacion/pagina/(:num)'] = 'C_reliquidadoReliquidacion/index/$1';
$route['C_reliquidadoReliquidacion'] = "C_reliquidadoReliquidacion";

$route['C_pendienteReliquidacion/pagina/(:num)'] = 'C_pendienteReliquidacion/index/$1';
$route['C_pendienteReliquidacion'] = "C_pendienteReliquidacion";

$route['C_criterioReliquidacionEscalar/pagina/(:num)'] = 'C_criterioReliquidacionEscalar/index/$1';
$route['C_criterioReliquidacionEscalar'] = "C_criterioReliquidacionEscalar";

$route['C_criterioReliquidacionOperador/pagina/(:num)'] = 'C_criterioReliquidacionOperador/index/$1';
$route['C_criterioReliquidacionOperador'] = "C_criterioReliquidacionOperador";

$route['C_criterioReliquidacionMineral/pagina/(:num)'] = 'C_criterioReliquidacionMineral/index/$1';
$route['C_criterioReliquidacionMineral'] = "C_criterioReliquidacionMineral";

$route['C_muestreoReliquidacion/pagina/(:num)'] = 'C_muestreoReliquidacion/index/$1';
$route['C_muestreoReliquidacion'] = "C_muestreoReliquidacion";

$route['C_declarado3/pagina/(:num)'] = 'C_declarado3/index/$1';
$route['C_declarado3'] = "C_declarado3";

$route['C_buscarM03/pagina/(:num)'] = 'C_buscarM03/index/$1';
$route['C_buscarM03'] = "C_buscarM03";

$route['C_buscarM02/pagina/(:num)'] = 'C_buscarM02/index/$1';
$route['C_buscarM02'] = "C_buscarM02";

$route['C_recepcion/pagina/(:num)'] = 'C_recepcion/index/$1';
$route['C_recepcion'] = "C_recepcion";

$route['C_concluido/pagina/(:num)'] = 'C_concluido/index/$1';
$route['C_concluido'] = "C_concluido";

$route['C_recepcion3/pagina/(:num)'] = 'C_recepcion3/index/$1';
$route['C_recepcion3'] = "C_recepcion3";

$route['C_declarado/pagina/(:num)'] = 'C_declarado/index/$1';
$route['C_declarado'] = "C_declarado";

$route['C_declaradoDetalle/pagina/(:num)'] = 'C_declaradoDetalle/index/$1';
$route['C_declaradoDetalle'] = "C_declaradoDetalle";

$route['C_usuario/pagina/(:num)'] = 'C_usuario/index/$1';
$route['C_usuario'] = "C_usuario";

$route['C_rechazado/pagina/(:num)'] = 'C_rechazado/index/$1';
$route['C_rechazado'] = "C_rechazado";

$route['C_fueraplazo/pagina/(:num)'] = 'C_fueraplazo/index/$1';
$route['C_fueraplazo'] = "C_fueraplazo";
          
$route['C_concluido3/pagina/(:num)'] = 'C_concluido3/index/$1';
$route['C_concluido3'] = "C_concluido3";

$route['C_rechazado3/pagina/(:num)'] = 'C_rechazado3/index/$1';
$route['C_rechazado3'] = "C_rechazado3";

$route['C_formm01/pagina/(:num)'] = 'C_formm01/index/$1';
$route['C_formm01'] = "C_formm01";

$route['C_rep_gral/pagina/(:num)'] = 'C_rep_gral/index/$1';
$route['C_rep_gral'] = "C_rep_gral";

$route['C_laboratorio/pagina/(:num)'] = 'C_laboratorio/index/$1';
$route['C_laboratorio'] = "C_laboratorio";

$route['C_aduana/pagina/(:num)'] = 'C_aduana/index/$1';
$route['C_aduana'] = "C_aduana";

$route['C_pais/pagina/(:num)'] = 'C_pais/index/$1';
$route['C_pais'] = "C_pais";

$route['C_cotizacionminera/pagina/(:num)'] = 'C_cotizacionminera/index/$1';
$route['C_cotizacionminera'] = "C_cotizacionminera";

$route['C_entidadaporte/pagina/(:num)'] = 'C_entidadaporte/index/$1';
$route['C_entidadaporte'] = "C_entidadaporte";

$route['C_municipio/pagina/(:num)'] = 'C_municipio/index/$1';
$route['C_municipio'] = "C_municipio";

$route['C_entidadfinanciera/pagina/(:num)'] = 'C_entidadfinanciera/index/$1';
$route['C_entidadfinanciera'] = "C_entidadfinanciera";

$route['C_subsector/pagina/(:num)'] = 'C_subsector/index/$1';
$route['C_subsector'] = "C_subsector";

$route['C_cotizaciondolar/pagina/(:num)'] = 'C_cotizaciondolar/index/$1';
$route['C_cotizaciondolar'] = "C_cotizaciondolar";

$route['C_cooperativa/pagina/(:num)'] = 'C_cooperativa/index/$1';
$route['C_cooperativa'] = "C_cooperativa";

$route['C_mineral/pagina/(:num)'] = 'C_mineral/index/$1';
$route['C_mineral'] = "C_mineral";

$route['C_nandina/pagina/(:num)'] = 'C_nandina/index/$1';
$route['C_nandina'] = "C_nandina";

$route['C_relacion/pagina/(:num)'] = 'C_relacion/index/$1';
$route['C_relacion'] = "C_relacion";

$route['C_frontera/pagina/(:num)'] = 'C_frontera/index/$1';
$route['C_frontera'] = "C_frontera";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
