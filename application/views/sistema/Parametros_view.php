<section class="content">
   <div class="row">
        <div class="col-xs-12">
            <?php if (isset($_SESSION['mensaje'])) { ?>
                <div class="alert alert-<?php echo ($_SESSION['mensaje'][0] == 'error') ? 'danger' : 'success'; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_SESSION['mensaje'][1]; ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-group">
                            <a href="<?php echo str_replace('/index.php', '', current_url()) . '/nuevo'; ?>" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Registrar Nuevo <?php echo $parametro['ParDes'] ?></a>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $parametro['ParDes'] ?> Registrados</h3>                                   
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="detalleParametros" class="table table-bordered table-striped" aria-describedby="example1_info">
                        <thead>
                            <tr class="info" role="row">
                                <th>
                                    Nombre
                                </th>
                                <th style="width: 100px;">
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php foreach ($detalleParams as $detalleParam): ?>
                                <tr>
                                    <td class=" "><?php echo $detalleParam['DprDes']; ?></td>
                                    <td class=" ">
                                      
                                        <a href="<?php echo str_replace('/index.php', '', current_url()) . '/editar/' . $detalleParam['DprId']; ?>" class="btn btn-default btn-flat" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <!--
                                        <a href="javascript:void(0);" onclick="confirmar('<?php echo base_url() . $parametro['ParCod'] . '/eliminar/' . $detalleParam['DprId']; ?>')" class="btn btn-danger btn-flat">
                                            <i class="fa fa-trash-o"></i> Eliminar
                                        </a>
                                        -->
                                        <span data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                            <a href="#modal-eliminar" role="button" data-toggle="modal" parametro="<?php echo $parametro['ParCod']; ?>" detalleparametro="<?php echo $detalleParam['DprId']; ?>" class="btn btn-default btn-flat">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
       </div>
    </div>
</section>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url() ?>frontend/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>frontend/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(function () 
{
//    $("#detalleParametros").dataTable();
    $("#detalleParametros").dataTable({
        "bSort": false,
        "paging": true
    });
});
</script>

   <!-- MODAL :   Eliminar Parametro -->
        <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-hidden="true">
            <form id="idelim" method="post">    
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> Eliminar Parametro</h4>
                    </div>
                        <div class="modal-body">
                            <input type="hidden" id="idSubactividad" name="id" value="" />
                            <h5 style="text-align: center">¿Realmente deseas eliminar este parametro y los datos asociados a el?</h5>
                        </div>     
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </form>
        </div><!-- /.modal -->
<script type="text/javascript">
$(document).ready(function()
{
   $(document).on('click', 'a', function(event) 
   {
        var parametro = $(this).attr('parametro');
        var detalleparametro = $(this).attr('detalleparametro');
        $('#idelim').attr('action',"<?php echo str_replace('/index.php', '', current_url()); ?>/eliminar/"+detalleparametro);
    });
});
</script>
