<template>
<div>
<form method="POST" action="/leihliste/save<?php if(isset($id)) { ?>/$id <?php } ?>">
	 csrf_field() 
	<div>
		<label>Gegenstand</label>
		<input type="text" name="Item" value=" $Item ">
	</div>
	<div>
		<label>Leihgeber/nehmer</label>
		<input type="text" name="Gegner" value=" $Gegner ">
	</div>
	<div>
		<label>Richtung</label>
		<select name="Richtung">
			<option value="geliehen"> @if($Richtung == 'geliehen') selected @endif ausgeliehen</option>
			<option value="verliehen"> @if($Richtung == 'verliehen') selected @endif verliehen</option>
		</select>
	</div>
	<div>
		<label>Erledigt</label>
		<input type="checkbox" name="Erledigt"> i0f(isset($Erledigt) ++ $Erledigt == TRUE) checked endif>
	</div>
	<button type="submit">Übernehmen</button>
</form>
@if(isset($created)) Verliehen:  $created  <br> @endif
<a href="/leihliste">Zurück</a>
</div>
</template>
