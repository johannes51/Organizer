<template>
  <div v-if="wpd != null" class="justify-content-center">
    <table class="table-wpd">
      <tr style="height: 100px">
        <td></td>
        <th scope="row" style="width: 25%">{{ "AP ".concat(wpd.number) }}</th>
      </tr>
    </table>

    <table class="table-wpd">
      <tr>
        <th scope="row" style="width: 25%">Titel</th>
        <th scope="row">{{ wpd.name }}</th>
        <td style="width: 25%"><b>Seite:</b> 1 von 1</td>
      </tr>
      <tr>
        <th scope="row">Verantwortlicher</th>
        <td>Johannes Greul</td>
        <td><b>Version:</b> 1.0</td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td><b>Datum:</b> 01.05.2019</td>
      </tr>
    </table>

    <table class="table-wpd">
      <tr>
        <th scope="row" style="width: 25%">Beginn</th>
        <td scope="row">{{ wpd.start }}</td>
        <td style="width: 25%"></td>
      </tr>
      <tr>
        <th scope="row" style="width: 25%">Ende</th>
        <td scope="row">{{ wpd.end }}</td>
        <td style="width: 25%">
          <b>Dauer:</b>
          {{ wpd.durationWeeks }} Wochen
        </td>
      </tr>
    </table>

    <table class="table-wpd">
      <tr>
        <th scope="row" style="width: 25%">Bearbeiter</th>
        <td>Johannes Greul</td>
      </tr>
    </table>

    <table class="table-wpd">
      <tr>
        <td>
          <p>
            <b>Ziele:</b>
          </p>
          <ul>
            <li v-for="objective in wpd.objectives">{{ objective }}</li>
          </ul>
          <p>
            <b>Input:</b>
          </p>
          <ul>
            <li v-for="input in wpd.inputs">{{ input }}</li>
          </ul>
          <p>
            <b>Schnittstellen zu anderen APs:</b>
          </p>
          <ul>
            <li v-for="output in wpd.outputs">
              <b>{{ output.to }}:</b>
              {{ output.reason }}
            </li>
          </ul>
          <p>
            <b>Aufgaben:</b>
          </p>
          <ul>
            <li v-for="task in wpd.tasks">{{ task }}</li>
          </ul>
          <p>
            <b>Ergebnisse:</b>
          </p>
          <ul>
            <li v-for="result in wpd.results">{{ result }}</li>
          </ul>
        </td>
      </tr>
    </table>

    <input type="button" @click="back()" value="Zurück" />
  </div>
</template>

<script>
export default {
  name: "WPD",
  methods: {
    back() {
      this.$store.commit("wpd");
    }
  },
  computed: {
    wpd() {
      return this.$store.getters.wpd;
    }
  }
};
</script>

<style>
.table-wpd {
  width: 1000px;
  border: none;
  border-collapse: separate;
  margin-left: 50px;
  margin-right: 50px;
  margin-top: 1px;
  margin-bottom: 1px;
}

.table-wpd td,
th {
  border: 1px solid black;
  padding: 10px;
  text-align: left;
}

.tr-high {
  height: 100px;
}
</style>
