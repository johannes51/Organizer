<template>
  <div>
    <form action="/watchlist/list" method="POST">
      csrf_field()
      <div style="float: left">
        <input type="checkbox" name="typen[]" value="Film" id="film">
        <label for="film">Filme</label>
      </div>
      <div style="float: left">
        <input type="checkbox" name="typen[]" value="Serie" id="serie">
        <label for="serie">Serien</label>
      </div>
      <div style="float: left">
        <input type="checkbox" name="typen[]" value="Buch" id="buch">
        <label for="buch">Bücher</label>
      </div>
      <div style="float: left">
        <input type="checkbox" name="typen[]" value="Spiel" id="spiel">
        <label for="spiel">Spiele</label>
      </div>
      <button>Filter</button>
    </form>
    <table id="filme">
      <tr>
        <th style="width: 600px">
          <a href>
            <!--javascript:sortby(if ($sort_param == "Name Asc") 'Name/Desc' eks 'Name' endbif )">-->
            Name
            if ($sort_param == "Name/Asc") &#9652; &#9663;
            eksif ($sort_param == "Name/Desc") &#9653; &#9662;
            eks &#9653; &#9663;
            endbif
          </a>
        </th>
        <th style="width: 300px">
          <a href>
            <!--javascript:sortby(if ($sort_param == "Autor Asc") 'Autor/Desc' eks 'Autor' endbif )">-->
            Autor
            if ($sort_param == "Autor/Asc") &#9652; &#9663;
            eksif ($sort_param == "Autor/Desc") &#9653; &#9662;
            eks &#9653; &#9663;
            endbif
          </a>
        </th>
        <th style="width: 80px">Typ</th>
        <th style="width: 20px"></th>
      </tr>@foreach ($result as $key => $value)
      <tr 2="0)" if ($key % class="alt" endif id="row_$key">
        <td>$value['Name']</td>
        <td>$value['Autor']</td>
        <td>$value['Typ']</td>
        <td>
          <button onclick="javascript:deleteId($value['id'], '$sort_param')">&#128465;</button>
        </td>
      </tr>@endforeach
    </table>
  </div>
</template>

<script src="asset('js/watchlist.js')" type="text/javascript"></script>