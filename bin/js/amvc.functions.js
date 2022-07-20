//Handle arrays pagination or query returns pagination
const paginate = (dataTo, perPage) => {
  let arrLimit = Math.round((dataTo.length / perPage) * 2);
  let arrIndex = 1;
  let tempArr = [];
  let returnArr = [];

  if (dataTo.length > perPage) {
    for (i = arrIndex; i < arrLimit; i++) {
      tempArr.push(dataTo.slice((i - 1) * perPage, i * perPage));
    }
    for (i = 0; p_i < tempArr.length; i++) {
      if (tempArr[i].length > 0) {
        returnArr.push(tempArr[i]);
      }
    }
  } else {
    returnArr.push(dataTo);
  }
  return returnArr;
};

//Function for creating various printing on page or in console
const print = {
  toEl: (el = null, str = null) => {
    if (document.querySelector(el)) {
      return (document.querySelector(el).innerHTML = str);
    }
    return console.error(
      'Error: the element "' + el + '" specified is not found'
    );
  },
  inEl: (el = null, str = null) => {
    if (document.querySelector(el)) {
      return (document.querySelector(el).innerHTML += str);
    }
    return console.error(
      'Error: the element "' + el + '" specified is not found'
    );
  },
  asEl: (el = null, str = null) => {
    if (document.querySelector(el)) {
      return (document.querySelector(el).outerHTML = str);
    }
    return console.error(
      'Error: the element "' + el + '" specified is not found'
    );
  },
  out: (str = null) => {
    return document.write(str);
  },
  in: (str = null) => {
    return console.log(str);
  },
};

//strips a specific character off the end and begining of a string
const cTrim = (str = null, char = null) => {
  str = str.split("");
  if (str[0] == char) {
    str[0] = "";
  }
  if (str[str.length - 1] == char) {
    str[str.length - 1] = "";
  }
  return str.join("");
};

const showIcons = () => {
  let allIcons = document.querySelectorAll(".icon");

  allIcons.forEach((icon) => {
    const iconName = icon.className.replace("icon s-", "");
    const iconPath = svgIcons[iconName];

    icon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                ${iconPath}
            </svg>
        `;

    if (iconName.includes("fill")) {
      icon.innerHTML = iconPath;
    }
  });
};

//Working functions

const ajax = (requestData, url, callback, method = "POST") => {
  var xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      callback(xmlhttp.responseText);
    }
  };
  xmlhttp.open(method, url, true);
  xmlhttp.send(requestData);
  return;
};

function timeSince(date) {
  date = new Date(date);

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    if (Math.floor(interval) == 1) {
      return Math.floor(interval) + " year";
    }
    return Math.floor(interval) + " years";
  }
  interval = seconds / 2592000;

  if (interval > 1) {
    if (Math.floor(interval) == 1) {
      return Math.floor(interval) + " month";
    }
    return Math.floor(interval) + " months";
  }
  interval = seconds / 86400;

  if (interval > 1) {
    if (Math.floor(interval) == 1) {
      return Math.floor(interval) + " day";
    }
    return Math.floor(interval) + " days";
  }
  interval = seconds / 3600;

  if (interval > 1) {
    if (Math.floor(interval) == 1) {
      return Math.floor(interval) + " hour";
    }
    return Math.floor(interval) + " hours";
  }
  interval = seconds / 60;

  if (interval > 1) {
    if (Math.floor(interval) == 1) {
      return Math.floor(interval) + " minute";
    }
    return Math.floor(interval) + " minutes";
  }
  return Math.floor(seconds) + " seconds";
}

const formValidator = (formId, config = []) => {
  let currentForm = document.getElementById(formId);

  config.forEach((currentConfig) => {
    document
      .getElementById(currentConfig.id)
      .setAttribute("validator", JSON.stringify(currentConfig.data));
  });

  currentForm.setAttribute("is-ready", 0);
  currentForm.setAttribute(
    "max-ready-count",
    currentForm.querySelectorAll("input[validate]").length
  );

  currentForm.querySelectorAll("input").forEach((item) => {
    item.setAttribute("parent-form-id", formId);

    let itemFunc = (e) => {
      item = e.currentTarget;
      if (item.hasAttribute("validate")) {
        item.setAttribute("is-validated", "true");

        let validators = JSON.parse(item.getAttribute("validator"));
        let validate = null;

        let parentForm = document.getElementById(
          item.getAttribute("parent-form-id")
        );
        let newIsReady = Number(parentForm.getAttribute("is-ready"));
        let maxReady = Number(parentForm.getAttribute("max-ready-count"));

        validators.forEach((validator) => {
          let messageOutput =
            document.getElementById(validator.m_o) ||
            document.createElement("text");

          if (validator.v.match(/^.{0,2}/)[0] == "??") {
            let interactorKey = validator.v.replace(/^.{0,2}/, "");
            let formData = new FormData();

            formData.append("input_value", item.value);

            let response = new AMVC().asyncInteract(
              interactorKey + ".php",
              formData
            );

            if (response == "0") {
              validate = false;
            } else {
              validate = true;
            }
          } else if (validator.v.match(/^.{0,2}/)[0] == "&&") {
            let toBeMatched = document.getElementById(
              validator.v.replace(/^.{0,2}/, "")
            );
            if (item.value == toBeMatched.value) {
              validate = true;
              toBeMatched.setAttribute("is-validated", "true");
            } else {
              validate = false;
              toBeMatched.setAttribute("is-validated", "false");
            }
          } else {
            validate = RegExp(validator.v).test(item.value);
          }

          if (!validate) {
            messageOutput.classList.add("active");
            if (newIsReady < maxReady)
              newIsReady++, item.setAttribute("is-validated", "false");
          } else {
            messageOutput.classList.remove("active");
            if (newIsReady > 0) {
              if (item.getAttribute("is-validated") == "false") {
                newIsReady--;
                item.setAttribute("is-validated", "true");
              }
            }
          }
        });

        parentForm.setAttribute("is-ready", newIsReady);

        let isReady = Number(parentForm.getAttribute("is-ready"));
        let actionButton = document.getElementById(
          parentForm.getAttribute("action-button")
        );

        if (isReady == 0) {
          //actionButton.removeAttribute('disabled')
        } else {
          //actionButton.setAttribute('disabled', '')
        }

        checkReady(parentForm);
      }
    };

    item.addEventListener("keyup", (e) => itemFunc(e));
  });

  function checkReady(parentForm) {
    let actionButton = document.getElementById(
      parentForm.getAttribute("action-button")
    );
    let allInputsAreEmpty = 0;

    parentForm.querySelectorAll("input").forEach((input) => {
      if (input.value.length < 1 && input.hasAttribute("validate"))
        allInputsAreEmpty++;
    });

    if (
      parentForm.querySelectorAll(".form-message.active").length == 0 &&
      allInputsAreEmpty == 0
    ) {
      actionButton.removeAttribute("disabled");
    } else {
      actionButton.setAttribute("disabled", "");
    }
  }
};

const $_GET = (param) => {
  var vars = {};
  window.location.href.replace(location.hash, "").replace(
    /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
    function (m, key, value) {
      // callback
      vars[key] = value !== undefined ? value : "";
    }
  );

  if (param) {
    return vars[param] ? vars[param] : null;
  }
  return vars;
};

const timeHandlers = () => {
  let is_there_any_time_ago = document.querySelectorAll(".time-ago").length > 0;
  let is_there_any_countdown =
    document.querySelectorAll(".countdown").length > 0;

  //function for handling all elements with class name of .time-ago from sql timestamp to time ago
  // the format of the element will be as follows <i class="time-ago" data-time="{timestamp}">{time ago}</i>
  // the time ago will be in the format of days, hours, minutes, seconds
  // make it realtime by converting to time ago every second and update the element
  const timeAgo = () => {
    let timeAgo = document.querySelectorAll(".time-ago");
    timeAgo.forEach((element) => {
      let time = element.getAttribute("data-time");
      let timeAgo = timeAgoConverter(time);
      element.innerHTML = timeAgo + " ago";
    });
  };

  // function for converting sql timestamp to time ago

  const timeAgoConverter = (time) => {
    let timeAgo = "";
    let timeDiff = new Date().getTime() - new Date(time).getTime();
    let days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    let hours = Math.floor(timeDiff / (1000 * 60 * 60));
    let minutes = Math.floor(timeDiff / (1000 * 60));
    let seconds = Math.floor(timeDiff / 1000);
    if (days > 0) {
      timeAgo = days + " days";
    } else if (hours > 0) {
      timeAgo = hours + " hours";
    } else if (minutes > 0) {
      timeAgo = minutes + " minutes";
    } else if (seconds > 0) {
      timeAgo = seconds + " seconds";
    }
    return timeAgo;
  };

  timeAgo();

  //now auto update the timeAgo every minute
  if (is_there_any_time_ago) timeAgo(), setInterval(timeAgo, 1000);

  //use time ago to countdown the time left which is 1hour if the time-ago element has the .countdown class
  const timeLeftConverter = (time) => {
    let timeLimit = amvcPageData.projectData.activation_link_request_due_time;
    let timeAgo = "";
    let timeDiff = new Date().getTime() - new Date(time).getTime();
    let days =
      hourTo.days(timeLimit) - Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    let hours =
      hourTo.hours(timeLimit) - Math.floor(timeDiff / (1000 * 60 * 60));
    let minutes =
      hourTo.minutes(timeLimit) - Math.floor(timeDiff / (1000 * 60));
    let seconds = hourTo.seconds(timeLimit) - Math.floor(timeDiff / 1000);

    if (days > 1) {
      timeAgo = days + " days";
    } else if (hours > 1) {
      timeAgo = hours + " hours";
    } else if (minutes > 1) {
      timeAgo = minutes + " minutes";
    } else if (seconds > 0) {
      timeAgo = seconds + " seconds";
    } else {
      timeAgo = "0 seconds";
    }
    return timeAgo;
  };

  const hourTo = {
    seconds: (time) => {
      return time * 60 * 60;
    },
    minutes: (time) => {
      return time * 60;
    },
    hours: (time) => {
      return time;
    },
    days: (time) => {
      return time / 24;
    },
  };

  const countdown = () => {
    let countdown = document.querySelectorAll(".countdown");
    countdown.forEach((element) => {
      let time = element.getAttribute("data-time");

      print.in(time);
      let onTimeElapsed = element.getAttribute("data-on-time-elapsed");
      let timeLeft = timeLeftConverter(time);

      if (timeLeft == "0 seconds") {
        eval(onTimeElapsed);
      }

      element.innerHTML = timeLeft + " left";
    });
  };

  //now auto update the countdown every minute
  if (is_there_any_countdown) countdown(), setInterval(countdown, 60000);
};
