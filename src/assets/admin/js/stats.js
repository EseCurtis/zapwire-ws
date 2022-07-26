const charts = {
  init() {
    gradientChartOptionsConfigurationWithTooltipGreen = {
      maintainAspectRatio: false,
      legend: {
        display: false,
      },

      tooltips: {
        backgroundColor: "#f5f5f5",
        titleFontColor: "#333",
        bodyFontColor: "#666",
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
      },
      responsive: true,
      scales: {
        yAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.0)",
              zeroLineColor: "transparent",
            },
            ticks: {
              suggestedMin: 50,
              suggestedMax: 125,
              padding: 20,
              fontColor: "#9e9e9e",
            },
          },
        ],

        xAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(0,242,195,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9e9e9e",
            },
          },
        ],
      },
    };

    gradientChartOptionsConfigurationWithTooltipPurple = {
      maintainAspectRatio: false,
      legend: {
        display: false,
      },

      tooltips: {
        backgroundColor: "#f5f5f5",
        titleFontColor: "#333",
        bodyFontColor: "#666",
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
      },
      responsive: true,
      scales: {
        yAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.0)",
              zeroLineColor: "transparent",
            },
            ticks: {
              suggestedMin: 60,
              suggestedMax: 125,
              padding: 20,
              fontColor: "#9a9a9a",
            },
          },
        ],

        xAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(225,78,202,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9a9a9a",
            },
          },
        ],
      },
    };

    gradientChartOptionsConfigurationWithTooltipOrange = {
      maintainAspectRatio: false,
      legend: {
        display: false,
      },

      tooltips: {
        backgroundColor: "#f5f5f5",
        titleFontColor: "#333",
        bodyFontColor: "#666",
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
      },
      responsive: true,
      scales: {
        yAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.0)",
              zeroLineColor: "transparent",
            },
            ticks: {
              suggestedMin: 50,
              suggestedMax: 110,
              padding: 20,
              fontColor: "#9a9a9a",
            },
          },
        ],

        xAxes: [
          {
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(220,53,69,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9a9a9a",
            },
          },
        ],
      },
    };

    var ctx = document.getElementById("chartLinePurple").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, "rgba(72,72,176,0.2)");
    gradientStroke.addColorStop(0.2, "rgba(72,72,176,0.0)");
    gradientStroke.addColorStop(0, "rgba(119,52,169,0)"); //purple colors

    var data1 = {
      labels: [
        "JAN",
        "FEB",
        "MAR",
        "APR",
        "MAY",
        "JUN",
        "JUL",
        "AUG",
        "SEP",
        "OCT",
        "NOV",
        "DEC",
      ],
      datasets: [
        {
          label: "Signups",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: "#d048b6",
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: "#d048b6",
          pointBorderColor: "rgba(255,255,255,0)",
          pointHoverBackgroundColor: "#d048b6",
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: signups_chart_data,
        },
      ],
    };

    var myChart = new Chart(ctx, {
      type: "line",
      data: data1,
      options: gradientChartOptionsConfigurationWithTooltipPurple,
    });

    var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, "rgba(66,134,121,0.15)");
    gradientStroke.addColorStop(0.4, "rgba(66,134,121,0.0)"); //green colors
    gradientStroke.addColorStop(0, "rgba(66,134,121,0)"); //green colors

    var data = {
      labels: [
        "JAN",
        "FEB",
        "MAR",
        "APR",
        "MAY",
        "JUN",
        "JUL",
        "AUG",
        "SEP",
        "OCT",
        "NOV",
        "DEC",
      ],
      datasets: [
        {
          label: "Channels Created",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: "#00d6b4",
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: "#00d6b4",
          pointBorderColor: "rgba(255,255,255,0)",
          pointHoverBackgroundColor: "#00d6b4",
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: channels_chart_data,
        },
      ],
    };

    var myChart = new Chart(ctxGreen, {
      type: "line",
      data: data,
      options: gradientChartOptionsConfigurationWithTooltipGreen,
    });

    var ctxGreen = document.getElementById("chartLineOrange").getContext("2d");
    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    var data = {
      labels: [
        "JAN",
        "FEB",
        "MAR",
        "APR",
        "MAY",
        "JUN",
        "JUL",
        "AUG",
        "SEP",
        "OCT",
        "NOV",
        "DEC",
      ],
      datasets: [
        {
          label: "Channels Created",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: "#2380f7",
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: "#2380f7",
          pointBorderColor: "rgba(255,255,255,0)",
          pointHoverBackgroundColor: "#2380f7",
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: logs_chart_data,
        },
      ],
    };

    var myChart = new Chart(ctxGreen, {
      type: "line",
      data: data,
      options: gradientChartOptionsConfigurationWithTooltipOrange,
    });
  },
};

const salert = (message = "{message}", type = "success") => {
  Swal.fire({
    icon: type,
    title: message,
    showConfirmButton: false,
    timer: 1500,
  });
};

const formHandler = (resp) => {
  resp = JSON.parse(resp);
  let respCode = resp.message[0];
  let path = resp.route;

  switch (path) {
    case "admin/message":
      if (respCode === "11") {
        salert("Message(s) Sent!", "success");
        setTimeout(() => {
          window.location.href = amvcPageData.siteUrl + "/admin-board";
        }, 2000);
      } else {
        switch (respCode) {
          case "0":
            salert("Please fill out the form", "error");
            break;
          case "1":
            salert("Server error, Try again.", "error");
            break;
        }
      }
      break;
    case "admin/mail":
      if (respCode === "11") {
        salert("Mail(s) Sent!", "success");
        setTimeout(() => {
          window.location.href = amvcPageData.siteUrl + "/admin-board";
        }, 2000);
      } else {
        switch (respCode) {
          case "0":
            salert("Please fill out the form", "error");
            break;
          case "1":
            salert("Server error, Try again.", "error");
            break;
        }
      }
      break;

    //admin/permissions
    case "admin/user/permissions":
      if (respCode === "11") {
        let message = ``;
        let responses = resp.message[1];

        for (let i = 0; i < responses.done.length; i++) {
          message += `${responses.done[i].message} status changed to ${responses.done[i].value == '1' ? 'Yes': 'No'}<br/>`;
        }

        for (let i = 0; i < responses.failed.length; i++) {
          message += `${responses.failed[i].message} status failed to change to ${responses.done[i].value == '1' ? 'Yes': 'No'}<br/>`;
        }

        salert(message, "success");
        console.log(message);
        setTimeout(() => {
          window.location.href = amvcPageData.siteUrl + "/admin-board/users";
        }, 3000);
      } else {
        switch (respCode) {
          case "0":
            salert("No update passed!", "error");
            break;
          case "1":
            salert("Server error, Try again.", "error");
            break;
        }
      }
    break;
    //admin/user/permissions/delete
    case "admin/user/permissions/delete":
      if (respCode === "11") {
        salert("User deleted!", "success");
        setTimeout(() => {
          window.location.href = amvcPageData.siteUrl + "/admin-board/users";
        }, 2000);
      } else {

        switch (respCode) {
          
          case "1":
            salert("Server Error", "error");
          break;
        }
      }
    break;

    //admin/user/new
    case "admin/user/new":
      if (respCode === "11") {
        salert("User Created!", "success");
        setTimeout(() => {
          window.location.href = amvcPageData.siteUrl + "/admin-board/users";
        }, 2000);
      } else {

        switch (respCode) {
          
          case "1":
            salert("Server Error", "error");
          break;
        }
      }
    break;

     //admin/permissions
     case "admin/user/generate":
      if (respCode === "11") {
        let message = ``;
        let responses = resp.message[1];

        for (let i = 0; i < responses.done.length; i++) {
          message += `User ${responses.done[i].email} Created<br/>`;
        }

        for (let i = 0; i < responses.failed.length; i++) {
          message += `User ${responses.done[i].email} Failed Creation<br/>`;
        }

        salert(message, "success");
        console.log(message);
        setTimeout(() => {
          window.location.href = amvcPageData.siteUrl + "/admin-board/users";
        }, 3000);
      } else {
        switch (respCode) {
          case "0":
            salert("Fill out the form", "error");
            break;
          case "1":
            salert("Server error, Try again.", "error");
            break;
        }
      }
    break;
  }

  
};
