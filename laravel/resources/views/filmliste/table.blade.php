
<table id="filme">
  <tr>
    <th style="width: 280px">
      <span class="namefield">
        <a href="javascript:sortby(@if ($sort_param == "NA") 'Name/Desc' @else 'Name' @endif )">
          Name
          @if ($sort_param == "NA") &#9652; &#9663;
          @elseif ($sort_param == "ND") &#9653; &#9662;
          @else &#9653; &#9663;
          @endif
      </a>
      </span>
      <span class="namefield">
        <a href="javascript:sortby('Rand')">
          &#x1f500;
        </a>
      </span>
    </th>
    <th style="width: 280px">
      <a href="javascript:sortby(@if ($sort_param == "RA") 'Regie/Desc' @else 'Regie' @endif )">
        Regie
        @if ($sort_param == "RA") &#9652; &#9663;
        @elseif ($sort_param == "RD")  &#9653; &#9662;
        @else &#9653; &#9663;
        @endif
      </a>
    </th>
    <th style="width: 75px">
      <a href="javascript:sortby(@if ($sort_param == "JA") 'Jahr/Desc' @else 'Jahr' @endif )">
        Jahr
        @if ($sort_param == "JA") &#9652; &#9663;
        @elseif ($sort_param == "JD") &#9653; &#9662;
        @else &#9653; &#9663;
        @endif
      </a>
    </th>
    <th style="width: 100px">Sprachen</th>
    <th style="width: 200px">Genres</th>
    <th style="width: 40px">Ges.</th>
  </tr>

  @foreach ($result as $key => $value)

  <tr id="row_{{ $key }}" @if ($key % 2 === 0) class="alt" @endif >
      <td>
        <a href="vlc://{{ $value['Pfad'] }}/{{$value['Dateiname']}}" >
          {{ $value['Name'] }}
        </a>
      </td>
      <td>{{ $value['Regie'] }}</td>
      <td>{{ $value['Jahr'] }}</td>
      <td>{{ $value['Sprachen'] }}</td>
      <td>{{ $value['Genre'] }}</td>
      <td>
        <button class="checkbox"
             id="checkbox_{{ $key }}"
             onclick="javascript:checkUncheck({{ $value['id'] . ", " . $value['Gesehen'] }})"
        >
          @if ($value['Gesehen'] == '0') ☐ @else ☑ @endif
        </button>
      </td>
    </tr>
  @endforeach
</table>
