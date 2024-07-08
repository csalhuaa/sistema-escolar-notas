<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tituloModal">Nuevo Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">       
                <form id="formUsuario" name="formUsuario">
                    <input type="hidden" id="idusuario" name="idusuario" value="">
                    <div class="mb-3">
                        <label for="control-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="control-label">Apellido Paterno:</label>
                        <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno">
                    </div>
                    <div class="mb-3">
                        <label for="control-label">Apellido Materno:</label>
                        <input type="text" class="form-control" name="apellido_materno" id="apellido_materno">
                    </div>
                    <div class="mb-3">
                        <label for="control-label">Usuario:</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                    </div>
                    <div class="mb-3">
                        <label for="control-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña">
                    </div>
                    <div class="mb-3">
                        <label for="control-label">Numero de Contacto:</label>
                        <input type="text" class="form-control" name="numero_contacto" id="numero_contacto">
                    </div>
                    <div class="mb-3">
                        <label for="control-label">Correo:</label>
                        <input type="text" class="form-control" name="info_contacto" id="info_contacto">
                    </div>
                    <div class="form-group">
                        <label for="listRol">Rol</label>
                        <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <!-- <label for="control-label">ID Rol:</label> -->
                        <input type="hidden" class="form-control" name="id_rol" id="id_rol" value="1">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="control-label">Especialidad:</label>
                        <input type="text" class="form-control" name="especialidad" id="especialidad">
                    </div> -->
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