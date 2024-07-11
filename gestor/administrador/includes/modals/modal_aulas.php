<div class="modal fade" id="modalAula" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitulo">Nueva Aula: </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAula" name="formAula">
                    <input type="hidden" id="idaula" name="idaula" value="">

                    <div class="mb-3">
                        <label for="id_grado" class="col-form-label">Grado:</label>
                        <select class="form-control" name="id_grado" id="id_grado">
                            <!-- Aquí se cargarán dinámicamente los docentes -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_seccion" class="col-form-label">Seccion:</label>
                        <select class="form-control" name="id_seccion" id="id_seccion">
                            <!-- Aquí se cargarán dinámicamente los docentes -->
                        </select>
                    </div>

                    <div class="mb-3">
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