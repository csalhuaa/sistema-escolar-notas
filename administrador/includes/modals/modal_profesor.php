<div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal">Nuevo Profesor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formProfesor" name="formProfesor">
                <input type="hidden" id="idprofesor" name="idprofesor" value="">
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" name="Nombre" id="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Apellido Paterno:</label>
                        <input type="text" class="form-control" name="Apellido_Paterno" id="Apellido_Paterno">
                    </div>
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Apellido Materno:</label>
                        <input type="text" class="form-control" name="Apellido_Materno" id="Apellido_Materno">
                    </div>
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Usuario:</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                    </div>
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña">
                    </div>
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Contacto:</label>
                        <input type="text" class="form-control" name="info_contacto" id="info_contacto">
                    </div>
                    <div class="form-group">
                        <label for="listRol">Rol</label>
                        <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                            <option value="profesor">Profesor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_rol">ID Rol</label>
                        <select class="form-control" name="id_rol" id="id_rol">
                            <option value="tutor">2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="control-label" class="col-form-label">Especialidad:</label>
                        <input type="text" class="form-control" name="especialidad" id="especialidad">
                    </div>
                    <div class="form-group">
                        <label for="est_reg">Estado de Registro:</label>
                        <select class="form-control" name="est_reg" id="est_reg">
                            <option value="activo">A</option>
                            <option value="inactivo">I</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="action">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
