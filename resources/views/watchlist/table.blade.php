<table id="filme">
  <tr>
    <th style="width: 600px">
      <a href="javascript:sortby(@if ($sort_param == "Name/Asc") 'Name/Desc' @else 'Name' @endif )">
        Name
        @if ($sort_param == "Name/Asc") &#9652; &#9663;
        @elseif ($sort_param == "Name/Desc") &#9653; &#9662;
        @else &#9653; &#9663;
        @endif
      </a>
    </th>
    <th style="width: 300px">
      <a href="javascript:sortby(@if ($sort_param == "Autor/Asc") 'Autor/Desc' @else 'Autor' @endif )">
        Autor
        @if ($sort_param == "Autor/Asc") &#9652; &#9663;
        @elseif ($sort_param == "Autor/Desc") &#9653; &#9662;
        @else &#9653; &#9663;
        @endif
    </a>
    </th>
    <th style="width: 80px">Typ</th>
    <th style="width: 20px"></th>
  </tr>
  @foreach ($result as $key => $value)
  <tr @if ($key % 2 === 0) class="alt" @endif id="row_{{ $key }}">
      <td>{{ $value['Name'] }}</td>
      <td>{{ $value['Autor'] }}</td>
      <td>{{ $value['Typ'] }}</td>
      <td><button onclick="javascript:deleteId({{ $value['id'] }}, '{{ $sort_param }}')">&#128465;</button>
  </tr>
  @endforeach
</table>
