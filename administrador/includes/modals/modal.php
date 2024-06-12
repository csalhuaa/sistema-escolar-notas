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
            <input type="text" class="form-control" name="nombre" id="nombre">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Apellido Paterno:</label>
            <input type="text" class="form-control" name="apePat" id="apePat">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Apellido Materno:</label>
            <input type="text" class="form-control" name="apeMat" id="apeMat">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Contacto:</label>
            <input type="text" class="form-control" name="contacto" id="contacto">
          </div>
          <div class="form-group">
            <label for="listRol">Rol</label>
            <select class="form-control" name="listRol" id="listRol">
              <option value="1">Administrador</option>
              <option value="2">Docente</option>
              <option value="3">Tutor</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
