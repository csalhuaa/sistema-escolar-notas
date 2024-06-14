<div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitulo">Nuevo Profesor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAlumno" name="formAlumno">
                    <input type="hidden" id="idalumno" name="idalumno" value="">
                    <div class="mb-3">
                        <label for="Nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" name="Nombre" id="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nac" class="col-form-label">Fecha Nacimiento:</label>
                        <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="col-form-label">Dirección:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>
                    <div class="form-group">
                        <label for="listPadre">Apoderado</label>
                        <select class="form-control" name="listpadre" id="listpadre">
                            <!-- Las opciones se llenarán dinámicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="est_reg">Estado de Registro:</label>
                        <select class="form-control" name="est_reg" id="est_reg">
                            <option value="A">A</option>
                            <option value="I">I</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" id="action" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>