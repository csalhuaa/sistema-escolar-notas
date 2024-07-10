<div class="modal fade" id="modalDocenteAula" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitulo">Asignación Docente Aula</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDocenteAula" name="formDocenteAula">
                    <input type="hidden" id="iddocenteaula" name="iddocenteaula" value="">
                    <div class="mb-3">
                        <label for="id_docente" class="col-form-label">Docente:</label>
                        <select class="form-control" name="id_docente" id="id_docente">
                            <!-- Aquí se cargarán dinámicamente los docentes -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_curso" class="col-form-label">Curso:</label>
                        <select class="form-control" name="id_curso" id="id_curso">
                            <!-- Aquí se cargarán dinámicamente los cursos -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_aula" class="col-form-label">Aula:</label>
                        <select class="form-control" name="id_aula" id="id_aula">
                            <!-- Aquí se cargarán dinámicamente las aulas -->
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
