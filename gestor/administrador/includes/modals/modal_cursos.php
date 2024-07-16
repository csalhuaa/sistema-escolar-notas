<div class="modal fade" id="modalCurso" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitulo">Nuevo Curso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCurso" name="formCurso">
                    <input type="hidden" id="idcurso" name="idcurso" value="">
                    <div class="mb-3">
                        <label class="col-form-label">Nombre Curso:</label>
                        <input type="text" class="form-control" name="Nombre" id="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="col-form-label">Descripción Curso:</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion">
                    </div>
                    <div class="form-group">
                        <label for="est_reg">Estado de Registro:</label>
                        <select class="form-control" name="est_reg" id="est_reg">
                            <option value="A">Activo</option>
                            <option value="I">Inactivo</option>
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