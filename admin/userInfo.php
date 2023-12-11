<div class="modal fade" id="samstrover<?php echo $row['id']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div style="text-align: center;">
                    <h4 class="modal-title" id="myModalLabel">Más información</h4>
                </div>
            </div>
            
            <?php
                $pro = mysqli_query($mysqli, "SELECT * FROM employees WHERE id='" . $row['id'] . "'");
                $prow = mysqli_fetch_array($pro);
            ?>
            
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>DNI</label>
                            <input name="dni" type="text" class="form-control" value="<?php echo $prow['dni']; ?>"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Código CIP</label>
                            <input name="cip" type="text" class="form-control" value="<?php echo $prow['cip']; ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombres</label>
                            <input name="name" type="text" class="form-control" value="<?php echo $prow['name']; ?>"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Apellido Paterno</label>
                            <input name="paterno" type="text" class="form-control"
                                value="<?php echo $prow['paterno']; ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Apellido Materno</label>
                            <input name="materno" type="text" class="form-control"
                                value="<?php echo $prow['materno']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Capítulo</label>
                            <input name="capitulo" type="text" class="form-control" value="<?php echo str_replace("_", " ", $prow['capitulo']); ?>"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Especialidad</label>
                            <input name="especialidad" type="text" class="form-control" value="<?php echo str_replace("_", " ", $prow['especialidad']); ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>N° de celular</label>
                            <input name="phone" type="text" class="form-control" value="<?php echo $prow['phone']; ?>"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha de último pago</label>
                            <input name="f_ultimomespago" type="text" class="form-control" value="<?php echo $prow['fechaultimopago']; ?>"
                                readonly>
                        </div>
                        
                    </div>

                    <?php
                        if($row['situacion'] == '1'):
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Lugar de entrega</label>
                            <input name="lugar_entrega" type="text" class="form-control" value="<?php echo $prow['lugar_entrega']; ?>"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha y hora de entrega</label>
                            <input name="fechahora_entrega" type="text" class="form-control" value="<?php echo $prow['fechahora_entrega']; ?>"
                                readonly>
                        </div>
                    </div>

                    <?php
                        endif;
                    ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>Fecha de incorporación</label>
                            <input name="fecha_incorporacion" type="text" class="form-control" value="<?php echo $prow['fecha_incorporacion']; ?>"
                                readonly>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>