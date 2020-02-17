<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <title>VALIDADOR | Ver. 1.7</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php base_url();?>ultima_lib/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- bootstrap & fontawesome -->
        <!-- <link rel="stylesheet" href="<?php base_url();?>assets/css/bootstrap.min.css" /> -->  <!-- descomentar -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" /> --> <!-- descomentar -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

        <!-- ace settings handler -->
        <script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
        
        <!-- jquery -->
        <script src="<?php echo base_url();?>assets/datapicker/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>
        <!--jquery ui-->
        <script src="<?php echo base_url();?>assets/datapicker/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        
        <link href="<?php echo base_url();?>assets/datapicker/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-duallistbox.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-multiselect.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />
        
        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <!-- ace.min.css General -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" /> -->  <!-- descomentar -->
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" /> --> <!-- descomentar -->

    <!-- ace settings handler -->
    <!--<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script> -->  <!-- descomentar -->
        
        <!-- Combo Anidado -->
<!--    <script src="<?php echo base_url();?>MiJS/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>MiJS/jquery-ui.js"></script>-->
        
<!--         <script src="<?php base_url();?>ultima_lib/jquery-1.9.1.js"></script> -->
<!--         <script src="<?php base_url();?>ultima_lib/jquery-ui.js"></script> -->
         
         <!--  amCharts V3    -->
<!--        <script src="<?= base_url() ?>dist/amcharts_3.3.4/amcharts.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>dist/amcharts_3.3.4/serial.js" type="text/javascript"></script>
-->
        <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->     <!-- descomentar -->
        <!-- <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script> --> <!-- descomentar -->
         
         
        <!--  amCharts V4  PARA EL EJEMPLO NRO 3  -->
        <link rel="stylesheet" href="<?php echo base_url()?>amcharts4/css/index.css" />
        <link rel="stylesheet" href="<?php base_url();?>ultima_lib/export.css" type="text/css" media="all" />
        <script src="<?php base_url();?>ultima_lib/amcharts.js"></script>
        <script src="<?php base_url();?>ultima_lib/serial.js"></script>
        <script src="<?php base_url();?>ultima_lib/export.min.js"></script>
        <script src="<?php base_url();?>ultima_lib/light.js"></script>
    

   
    
    </head>


<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    LISTADO FORM - M02
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Envio
                    </small>
                </h1>
            </div>
        </div>
***********************
<div class="col-xs-8">
<tr>
<td>
    <div class="table-header">
        Results for "Latest Registered Domains"
    </div>
    <!-- div.table-responsive -->

    <!-- div.dataTables_borderWrap -->
    <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead style="font-size:10px">
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Vendedor</th>
                    <th style="text-align: center">Fecha Transaccion</th>
                    <th style="text-align: center">Total Kilos Finos</th>
                    <th style="text-align: center">Total vbv [Bs]</th>
                    <th style="text-align: center">Senarecom</th>
                    <th style="text-align: center"></th>

                </tr>
            </thead>
            <tbody style="font-size:10px">

                <?php foreach ($recepciones as $recep) { ?>
                <tr>
                    <td class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td style="text-align: left"><?php echo $recep->id;?></td>
                    <td style="text-align: left"><?php echo $recep->razonsocialvendedor;?></td>
                    <td style="text-align: center"><?php echo $recep->fechatransaccion;?></td>
                    <td style="text-align: right"><?php echo number_format($recep->totalkilosfinos,2);?></td>
                    <td style="text-align: right"><?php echo number_format($recep->totalvbvbs,2);?></td>
                    <td style="text-align: left"><?php echo $recep->oficinavalidacion;?></td>

                </tr>
                <?php } ?>
            </tbody>


        </table>

    </div>
</td>
<td>
    <div class="col-xs-2">
        Total Deposito
        <br>
        Numero form 
        <br>
        Saldo
    </div>
 </td>   
</tr>


        <!--[if !IE]> -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- page specific plugin scripts -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="assets/js/dataTables.buttons.min.js"></script>
        <script src="assets/js/buttons.flash.min.js"></script>
        <script src="assets/js/buttons.html5.min.js"></script>
        <script src="assets/js/buttons.print.min.js"></script>
        <script src="assets/js/buttons.colVis.min.js"></script>
        <script src="assets/js/dataTables.select.min.js"></script>

        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                //initiate dataTables plugin
                var myTable = 
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable( {
                    bAutoWidth: false,
                    "aoColumns": [
                      { "bSortable": false },
                      null, null,null, null, null,
                      { "bSortable": false }
                    ],
                    "aaSorting": [],
                    
                    
                    //"bProcessing": true,
                    //"bServerSide": true,
                    //"sAjaxSource": "http://127.0.0.1/table.php"   ,
            
                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,
            
                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
            
                    //"iDisplayLength": 50
            
            
                    select: {
                        style: 'multi'
                    }
                } );
            
                
                
                $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
                
                new $.fn.dataTable.Buttons( myTable, {
                    buttons: [
                      {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                      },
                      {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                      }       
                    ]
                } );
                myTable.buttons().container().appendTo( $('.tableTools-container') );
                
                //style the message box
                var defaultCopyAction = myTable.button(1).action();
                myTable.button(1).action(function (e, dt, button, config) {
                    defaultCopyAction(e, dt, button, config);
                    $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
                });
                
                
                var defaultColvisAction = myTable.button(0).action();
                myTable.button(0).action(function (e, dt, button, config) {
                    
                    defaultColvisAction(e, dt, button, config);
                    
                    
                    if($('.dt-button-collection > .dropdown-menu').length == 0) {
                        $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                    }
                    $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
                });
            
                ////
            
                setTimeout(function() {
                    $($('.tableTools-container')).find('a.dt-button').each(function() {
                        var div = $(this).find(' > div').first();
                        if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                        else $(this).tooltip({container: 'body', title: $(this).text()});
                    });
                }, 500);
                
                
                
                
                
                myTable.on( 'select', function ( e, dt, type, index ) {
                    if ( type === 'row' ) {
                        $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                    }
                } );
                myTable.on( 'deselect', function ( e, dt, type, index ) {
                    if ( type === 'row' ) {
                        $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                    }
                } );
            
            
            
            
                /////////////////////////////////
                //table checkboxes
                $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
                
                //select/deselect all rows according to table header checkbox
                $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header
                    
                    $('#dynamic-table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) myTable.row(row).select();
                        else  myTable.row(row).deselect();
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                    var row = $(this).closest('tr').get(0);
                    if(this.checked) myTable.row(row).deselect();
                    else myTable.row(row).select();
                });
            
            
            
                $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                });
                
                
                
                //And for the first simple table, which doesn't have TableTools or dataTables
                //select/deselect all rows according to table header checkbox
                var active_class = 'active';
                $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header
                    
                    $(this).closest('table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if($row.is('.detail-row ')) return;
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
            
                
            
                /********************************/
                //add tooltip for small view action buttons in dropdown menu
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                
                //tooltip placement on right or left
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    //var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
                
                
                
                
                /***************/
                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
                /***************/
                
                
                
                
                
                /**
                //add horizontal scrollbars to a simple table
                $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
                  {
                    horizontal: true,
                    styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
                    size: 2000,
                    mouseWheelLock: true
                  }
                ).css('padding-top', '12px');
                */
            
            
            })
        </script>