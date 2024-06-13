<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal">Nuevo Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formulario" name="formulario">
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
              <option value="administrador">Administrador</option>
              <option value="docente">Docente</option>
              <option value="tutor">Tutor</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">ID Rol:</label>
            <input type="text" class="form-control" name="id_rol" id="id_rol">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Especialidad:</label>
            <input type="text" class="form-control" name="especialidad" id="especialidad">
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
