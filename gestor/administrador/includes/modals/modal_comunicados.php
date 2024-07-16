<div class="modal fade" id="modalComunicado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tituloModal">Nuevo Comunicado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formComunicado" name="formComunicado">
                    <input type="hidden" id="idcomunicado" name="idcomunicado" value="">
                    <div class="mb-3">
                        <label for="titulo" class="col-form-label">Título:</label>
                        <input type="text" class="form-control" name="titulo" id="titulo">
                    </div>
                    <div class="mb-3">
                        <label for="id_rol" class="col-form-label">Destinatario:</label>
                        <select class="form-control" name="id_rol" id="id_rol">
                            <option value="2">Docentes</option>
                            <option value="3">Tutores</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="asunto" class="col-form-label">Asunto:</label>
                        <textarea class="form-control" name="asunto" id="asunto" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="col-form-label">Fecha del Evento:</label>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>
                    <div class="mb-3">
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
