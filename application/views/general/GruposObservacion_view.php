<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php if (isset($_SESSION['mensaje'])) { ?>
                <div class="alert alert-<?php echo ($_SESSION['mensaje'][0] == 'error') ? 'danger' : 'success'; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_SESSION['mensaje'][1]; ?>
                </div>
            <?php } ?>
            <?php if ($this->acceso_cls->tienePermiso('editar_grupo_observacion')) { ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-group">
                            <a href="<?php echo base_url() ?>configuracion/grupo_observacion/nuevo" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Registrar nuevo Grupo de Observaciones</a>
                        </div>
                    </div>
                </div> 
            </div>
            <?php } ?>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Grupos de Observaciones registrados</h3>                                   
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="GrupoObservaciones" class="table table-bordered" aria-describedby="example1_info">
                        <thead>
                            <tr Class="info" role="row">
                                <th>
                                    Nombre
                                </th>
                                <th style="width: 100px;">
                                    Acción
                                </th>
                            </tr>
                        </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php foreach ($actividades as $actividad) { ?>
                                <tr class="nivel1">
                                    <td colspan="2">
                                        <?php echo $actividad['ActDes'] ?>
                                    </td>
                                    <td style="display: none">
                                    </td>
                                </tr>
                                <?php foreach ($actividad['gruposObservacion'] as $grupoObservacion) { ?>
                                    <tr>
                                        <td>
                                            <span class="nivel2"><?php echo (isset($grupoObservacion['GoaDes'])) ? $grupoObservacion['GoaDes'] : ''; ?></span>
                                        </td>
                                        <td class=" ">
                                            <?php if ($this->acceso_cls->tienePermiso('editar_grupo_observacion')) { ?>
                                            <a href="<?php echo base_url() . 'configuracion/grupo_observacion/editar/' . $grupoObservacion['GoaId']; ?>" class="btn btn-default btn-flat" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php } ?>
                                            <?php if ($this->acceso_cls->tienePermiso('eliminar_grupo_observacion')) { ?>
                                            <span data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                                <a href="#modal-eliminar" role="button" data-toggle="modal" identi="<?php echo $grupoObservacion['GoaId']; ?>" class="btn btn-default btn-flat">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
</section>
<!-- MODAL :   Eliminar penalidad -->
<div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-hidden="true">
    <form id="idelim" method="post">    
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Eliminar Penalidad</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idSubactividad" name="id" value="" />
                    <h5 style="text-align: center">¿Realmente desea eliminar este grupo de observación y los datos asociados?</h5>
                </div>     
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url() ?>frontend/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>frontend/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#GrupoObservaciones").dataTable({
            "bSort": false,
            "paging": true
  	});
        
        $(document).on('click', 'a', function (event)
        {
            var identi = $(this).attr('identi');
            $('#idelim').attr('action', "<?php echo base_url() . 'configuracion/grupo_observacion/eliminar/'; ?>" + identi);
        });
    });
</script>