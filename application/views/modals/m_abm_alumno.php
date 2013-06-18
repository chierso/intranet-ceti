<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
      <h3 id="myModalLabel">Asignar Tutoría</h3>
    </div>
    <div class="modal-body">
      <p>
        <form method="post" action="<?php echo base_url("abm/abm_subject/asignar_tutoria")?>" id="frm_add">
          Docente : <span id="pDocente"></span>
          <hr />
          <input type="hidden" name="id_docente" id="id_docente" value="0" />
          <div class="row-fluid">
      <div class="span6">
        <label for="grade">Grado: </label>
        <select id="grade" name="cbx_grado">
          <option value="1">1 º</option>
          <option value="2">2 º</option>
          <option value="3">3 º</option>
          <option value="4">4 º</option>
          <option value="5">5 º</option>  
        </select>
      </div>
      <div class="span6">
        <label>Sección: </label>
        <label class="radio inline"> 
            <input type="radio" name="rbt_seccion" value="A">A
        </label>
        <label class="radio inline"> 
            <input type="radio" name="rbt_seccion" value="B">B
        </label>
        <label class="radio inline"> 
          <input type="radio" name="rbt_seccion" value="C">C
        </label>
      </div>
  </div>
  <input type="submit" value="add" class="btn" />
        </form>        
      </p>
    </div>
    <div class="modal-footer">
      <div class="row-fluid fila_datos">
        <div class="progress progress-striped span7">
        <div class="bar"></div>
      </div>
      <div>
        <button type="submit" name="btn_confirmar" class="btn btn-primary">Guardar</button>
          <button type="button" name="btn_cancelar2" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
      </div>                
      </div>          
    </div>
</div>