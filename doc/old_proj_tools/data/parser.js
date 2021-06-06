import moment from "moment";

export function parse_response(response, fn) {
  var result = {
    wbs: Object(),
    wpdData: [],
    taskData: {
      data: [],
      links: []
    },
    numberIdTable: []
  };
  var wbsArray = [];

  result.wbs.text = {
    name: "Studienarbeit Johannes Greul",
    role: "blablalba Thema"
  };
  result.wbs.children = Array();

  response.data.forEach(element => {
    parseWp(result, wbsArray, element, fn);
  });

  Object.assign(result.wbs, { children: make_tree(wbsArray) });
  result.taskData.links = make_links(result.wpdData);

  return result;
}

function parseWp(result, wbsArray, wp, fn) {
  result.wpdData.push(make_wpd(wp));
  if ("start" in wp) {
    result.taskData.data.push(make_task(wp));
  }
  wbsArray.push(make_box(wp, fn));
  result.numberIdTable.push({ number: wp.number, id: wp.id });
}

function make_wpd(wp) {
  var result = {
    number: wp.number,
    name: wp.name
  };
  if ("start" in wp) {
    Object.assign(result, { start: moment(wp.start).format("DD.MM.YYYY") });
    var weeks = Math.round(wp.duration * 2) / 2;
    Object.assign(result, { durationWeeks: weeks });
    Object.assign(result, {
      end: moment(wp.start)
        .add(moment.duration(wp.duration, "weeks"))
        .format("DD.MM.YYYY")
    });
  }

  if ("objectives" in wp) {
    Object.assign(result, { objectives: wp.objectives });
  }
  if ("inputs" in wp) {
    Object.assign(result, { inputs: wp.inputs });
  }
  if ("outputs" in wp) {
    Object.assign(result, { outputs: wp.outputs });
  }
  if ("tasks" in wp) {
    Object.assign(result, { tasks: wp.tasks });
  }
  if ("results" in wp) {
    Object.assign(result, { results: wp.results });
  }

  return result;
}

function make_task(wp) {
  return {
    id: wp.number,
    text: "AP "
      .concat(wp.number)
      .concat(": ")
      .concat(wp.name),
    start_date: moment(wp.start).format("DD-MM-YYYY"),
    duration: moment.duration(wp.duration, "weeks").asDays(),
    progress: 0
  };
}

function make_links(data) {
  var result = [];
  data.forEach(element => {
    if ("outputs" in element) {
      var source = element.number;
      element.outputs.forEach(output => {
        var to = output.to.substr(3);
        var targets = [];
        if (to.includes("+")) {
          targets.push(to.substr(0, 4));
          targets.push(to.substr(5, 4));
        } else if (to.includes("-")) {
          for (
            let index = to.substr(0, 4);
            index <= to.substr(0, 4);
            index += 100
          ) {
            targets.push(index);
          }
        } else {
          targets.push(to);
        }
        targets.forEach(target => {
          result.push({
            id: result.length,
            source: source,
            target: target,
            type: "0"
          });
        });
      });
    }
  });
  return result;
}

function make_box(wp, fn) {
  return {
    text: {
      name: {
        val: "AP ".concat(wp.number)
      },
      role: {
        val: wp.name
      }
    },
    stackChildren: true,
    link: {
      onclick: fn
    },
    HTMLid: wp.number
  };
}

function make_tree(wbsArray) {
  var result = [];
  var hundreds = [];
  wbsArray.forEach(element => {
    if (element.HTMLid % 1000 == 0) {
      result.push(Object.assign(element, { children: [] }));
    } else if (element.HTMLid % 100 == 0) {
      hundreds.push(element);
    }
  });
  result.forEach(function(thousand, index, thousands) {
    hundreds.forEach(function(hundred) {
      if (
        hundred.HTMLid > thousand.HTMLid &&
        hundred.HTMLid < thousand.HTMLid + 1000
      ) {
        thousands[index].children.push(hundred);
      }
    });
  });
  return result;
}
