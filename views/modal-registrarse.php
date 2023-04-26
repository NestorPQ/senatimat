
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-registro-usuarios" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-titulo">Nuevo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="abrir-modal"></button>
      </div>
      <div class="modal-body">
        
      <!-- Cuerpo del modal -->

      <form id="formulario-usuarios" autocomplete="off">
        <div class="mb-3">
          <label for="nombreusuario" class="form-label">Usuario:</label>
          <input type="text" class="form-control form-control-sm" id="nombreusuario" placeholder="Escriba un usuario" required>
        </div>
        <div class="mb-3">
          <label for="nombres" class="form-label">Nombre:</label>
          <input type="text" class="form-control form-control-sm" id="nombres" placeholder="Escriba su nombre" required>
        </div>
        <div class="mb-3">
          <label for="apellidos" class="form-label">Apellido:</label>
          <input type="text" class="form-control form-control-sm" id="apellidos" placeholder="Escriba su apellido" required>
        </div>
        <div class="mb-3">
          <label for="claveacceso" class="form-label">Clave:</label>
          <input type="password" class="form-control form-control-sm" id="claveacceso" placeholder="Escriba su clave"required>
        </div>
      </form>

      <!-- Fin del  cuerpo del modal -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardar-usuario">Guardar</button>
      </div>
    </div>
  </div>
</div>

</script>

