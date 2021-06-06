<template>
  <div ref="gantt"></div>
</template>

<script>
import gantt from "dhtmlx-gantt";

import { mapGetters } from "vuex";

export default {
  name: "gantt",
  data() {
    return {
      tasks: { data: [], links: [] }
    };
  },
  computed: mapGetters(["taskData"]),
  methods: {
    initGantt() {
      if (!gantt.$_eventsInitialized) {
        // gantt.showDate(new Date());
        gantt.config.autosize = true;
        gantt.config.autosize_minwidth = 500;
        gantt.config.autoscroll = true;
        gantt.config.show_grid = false;
        gantt.config.select_task = false;
        gantt.config.drag_links = false;
        gantt.config.fit_tasks = true;
        gantt.config.scale_unit = "day";
        gantt.config.date_scale = "%d";
        gantt.config.min_column_width = 25;
        gantt.templates.scale_cell_class = function(date) {
          var today = new Date();
          if (
            date.getFullYear() == today.getFullYear() &&
            date.getMonth() == today.getMonth() &&
            date.getDate() == today.getDate()
          ) {
            return "today";
          } else if (date.getDay() == 6) {
            return "saturday";
          } else if (date.getDay() == 0 || date.getDay() == 6) {
            return "sunday";
          }
        };
        gantt.config.subscales = [
          { unit: "week", step: 1, date: "KW #%W" },
          { unit: "month", step: 1, date: "%F" }
        ];
        gantt.config.scale_height = 54;
        gantt.attachEvent("onAfterTaskUpdate", this.handleTaskUpdate);
        gantt.$_eventsInitialized = true;
      }
    },
    handleTaskUpdate(id, task) {
      var payload = {
        number: id,
        start: task.start_date,
        duration: task.duration / 7,
        progress: task.progress
      };
      this.$store.dispatch("updateWpTime", payload);
    }
  },
  mounted() {
    this.initGantt();
    if (this.taskData != null) {
      this.$data.tasks = JSON.parse(JSON.stringify(this.taskData));
      gantt.init(this.$refs.gantt);
      gantt.parse(this.$data.tasks);
    }
  }
};
</script>

<style>
@import "~dhtmlx-gantt/codebase/dhtmlxgantt.css";

.saturday {
  background: #d1a93c !important;
  color: white !important;
}

.sunday {
  background: #c7526f !important;
  color: white !important;
}

.today {
  background: #2834d3 !important;
  color: white !important;
}
</style>
