<div class="modal fade" id="modalMatricula" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitulo">Matricula Alumnos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formMatricula" name="formMatricula">
                    <input type="hidden" id="idmatricula" name="idmatricula" value="">
                    <div class="mb-3">
                        <label for="id_estudiante" class="col-form-label">Estudiante:</label>
                        <select class="form-control" name="id_estudiante" id="id_estudiante">
                            <!-- Aquí se cargarán dinámicamente los docentes -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_grado" class="col-form-label">Grado:</label>
                        <select class="form-control" name="id_grado" id="id_grado">
                            <!-- Aquí se cargarán dinámicamente los Grados -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_seccion" class="col-form-label">Seccion:</label>
                        <select class="form-control" name="id_seccion" id="id_seccion">
                            <!-- Aquí se cargarán dinámicamente las Secciones -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="año" class="col-form-label">Año:</label>
                        <input type="text" class="form-control" name="año" id="año">
                    </div>
                    <div class="mb-3">
                        <label for="est_reg" class="col-form-label">Estado de Registro:</label>
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
