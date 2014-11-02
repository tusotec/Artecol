
<!-- Instrucciones:
  Esta vista actua mas bien como un helper.
  
  - Primero hay que definir un array llamado $table.
  Deben haber 3 objetos en este array:
  - ['names']    Un array que contiene los nombres de la columna.
  - ['data']     Un array que contiene los objetos de la tabla.
    puede ser un paginador, en ese caso se mostraran los links de las paginas.
  - ['function'] Una funcion anonima.
    A la funcion se le pasara como parametro cada objeto de ['data'].
    Debe devolver un array con cada dato de la fila de dicho objeto.
  - El array que devuelve ['function'] debe respetar el orden de ['names'].
  - Todos estos arrays deben ser simples, no de llave-valor.
  - ['order'] Un array llave-valor opcional con las columnas que pueden ser ordenadas.
    La llave es el nombre de la columna en la pagina.
    El valor es el nombre de la columna en la base de datos.
-->

<?php 
  if (!isset($table['order'])) {
    $table['order'] = array();
  }
  $t_route_name = Route::currentRouteName();

 ?>

<table>
  <tr>
    @foreach ($table['names'] as $column_name)
      @if (is_array($column_name))
        <th colspan="{{$column_name[1]}}">{{$column_name[0]}}</th>
      @elseif (isset($table['order'][$column_name]))
        <?php $t_r_data = ['order' => $table['order'][$column_name]]; ?>
        <th>{{link_to(route($t_route_name, $t_r_data), $column_name)}}</th>
      @else
        <th>{{$column_name}}</th>
      @endif
    @endforeach
  </tr>
  @foreach ($table['data'] as $row_object)
    <tr>
      @foreach ($table['function']($row_object) as $row_column)
        <td>{{$row_column}}</td>
      @endforeach
    </tr>
  @endforeach
</table>

@if ($table['data'] instanceof Illuminate\Pagination\Paginator)
  <?php 
    $t_r_data = array();
    $t_order = Input::get('order');
    if ($t_order != null) {
      $t_r_data['order'] = $t_order;
    }
   ?>
  <ul class="pagination">
    @for ($i=1; $i <= $table['data']->getLastPage(); $i++)
      <?php
        $t_r_data['page'] = $i;
        $t_route = route($t_route_name, $t_r_data);
       ?>
      <li<?php if($i == Input::get('page', 1)) {echo ' class="active"';} ?>>{{link_to($t_route, $i)}}</li>
    @endfor
  </ul>
@endif
