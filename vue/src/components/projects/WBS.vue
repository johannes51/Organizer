<template>
  <div id="wbs"></div>
</template>

<script>
export default {
  name: "WBS",
  props: ["nodeStructure"],
  data() {
    return {
      treantData: {
        chart: {
          container: "#wbs",
          connectors: {
            type: "step"
          },
          node: {
            HTMLclass: "wpNode"
          }
        },
        nodeStructure: null
      }
    };
  },
  methods: {
    watch_mutation(mutation) {
      if (
        (mutation.type = "nodeStructure" && mutation.payload != null) &&
        this.$data.treantData.nodeStructure == null
      ) {
        this.$data.treantData.nodeStructure = mutation.payload;
        new Treant(this.$data.treantData);
      }
    }
  },
  created() {
    this.$store.subscribe(this.watch_mutation);
  },
  mounted() {
    if (
      this.nodeStructure != null &&
      this.$data.treantData.nodeStructure == null
    ) {
      this.$data.treantData.nodeStructure = this.nodeStructure;
      new Treant(this.$data.treantData);
    }
  }
};
</script>

<style scoped>
body,
div,
dl,
dt,
dd,
ul,
ol,
li,
h1,
h2,
h3,
h4,
h5,
h6,
pre,
form,
fieldset,
input,
textarea,
p,
blockquote,
th,
td {
  margin: 0;
  padding: 0;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}
fieldset,
img {
  border: 0;
}
address,
caption,
cite,
code,
dfn,
em,
strong,
th,
var {
  font-style: normal;
  font-weight: normal;
}
caption,
th {
  text-align: left;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  font-size: 100%;
  font-weight: normal;
}
q:before,
q:after {
  content: "";
}
abbr,
acronym {
  border: 0;
}

body {
  background: #fff;
}
/* optional Container STYLES */
.chart {
  height: 1000px;
  margin: 5px;
  width: 900px;
}
.Treant > .node {
}
.Treant > p {
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue",
    Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: bold;
  font-size: 12px;
}
.node-name {
  font-weight: bold;
}

.wpD.wpNode {
  padding: 2px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #ffffff;
  border: 3px solid #000;
  width: 200px;
  font-family: Tahoma;
  font-size: 12px;
}
</style>
