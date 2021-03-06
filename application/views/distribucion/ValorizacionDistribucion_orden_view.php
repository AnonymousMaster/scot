<!-- REPORTE DE ORDEN DE TRABAJO -->
<section class="invoice">
    <?php if (isset($_SESSION['mensaje'])) { ?>
        <div class="alert alert-<?php echo ($_SESSION['mensaje'][0] == 'error') ? 'danger' : 'success'; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $_SESSION['mensaje'][1]; ?>
        </div>
    <?php } ?>
    <form role="form" accept-charset="utf-8" enctype="multipart/form-data" method="post">
        <div id="impresion">
            <div class="row">
                <div class="col-xs-12">
                    <h5><i class="fa fa-file"></i> VALORIZACIÓN N°: <?php echo $valorizacion['VlrNum'] . '  -  ' . $actividad["ActDes"]; ?></h5>
                    <h5>ORDEN DE TRABAJO N°: <?php echo $orden['OrtNum'] ?></h5>
                    <small class="pull-right">Periodo: <?php echo $valorizacion['VlrFchIn'].' - '.$valorizacion['VlrFchFn'] ?></small>
                </div>
            </div>
            <hr style="margin-top:10px;margin-bottom: 10px;">
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                    <b>Contratista:</b> <?php echo $contratista['CstRaz']; ?><br>
                    <b>Metrado Planificado:</b> <?php echo $orden['metradoPl']; ?><br>
                    <b>Metrado Ejecutado:</b> <?php echo $orden['metradoEj']; ?><br>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <b>Subtotal S/:</b> <?php echo number_format($orden['subtotal'], 3); ?><br>
                    <b>Descuento S/:</b> <?php echo number_format($orden['descuento'], 3); ?><br>
                    <b>Total S/:</b> <?php echo number_format($orden['total'], 3); ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <hr style="margin-top:10px;margin-bottom: 10px;">
            <!-- Table row -->
            <div class="row invoice-info">
                <div class="col-xs-12">
                    <h4>Resumen por Subactividad: </h4>
                    <div class="table-responsive">
                        <table id="lecturas" class="table table-bordered table-striped">
                            <thead>
                                <tr Class="info" role="row">
                                    <th>Subactividad</th>
                                    <th>Metrado ejecutado</th>
                                    <th>Precio Unitario S/</th>
                                    <th>SubTotal S/</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ordenSubs as $key => $ordenSub): ?>
                                    <tr>
                                        <td rowspan="3"><?php echo $ordenSub['SacDes']; ?></td>
                                        <td >Regulares: <?php echo $ordenSub['cantLecturas']; ?></td>
                                        <td rowspan="3"><?php echo round($ordenSub['OtsPreUn'],2); ?></td>
                                        <td rowspan="3"><?php echo round($ordenSub['OtsMonEj'],2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Control: <?php echo $ordenSub['cantLecturasControl'] + $ordenSub['cantLecturasAtip'] ; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total: <?php echo $ordenSub['OtsMetEj']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr style="margin-top:10px;margin-bottom: 10px;">
            <!-- Table row -->
            <div class="row no-print invoice-info">
                <div class="col-xs-12">
                    <h4>Penalizaciones</h4>
                    <div class="table-responsive">
                        <table id="observaciones" class="table table-bordered table-striped">
                            <thead>
                                <tr Class="info" role="row">
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Casos</th>
                                    <th>Dias </th>
                                    <th>Monto S/</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penalizaciones as $penalizacion) { ?>
                                    <tr>
                                        <td><?php echo $penalizacion['PnzCod']; ?></td>
                                        <td><?php echo $penalizacion['PnzDes']; ?></td>
                                        <td><?php echo $penalizacion['PnzCas']; ?></td>
                                        <td><?php echo $penalizacion['PnzDia']; ?></td>
                                        <td><?php echo $penalizacion['PnzMon']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </form>   
</section>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url() ?>frontend/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>frontend/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function ()
{
    $("#observaciones").dataTable({
            "bSort": false,
            "paging": true
    });
});
</script>

