<template>
  <div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-30">
          <div class="card-body">
            <h4 class="card-title m-0">This Week Reservations</h4>
            <div class="chart-wrapper">
              <div v-once class="typo__p text-right" v-if="isLoading">
                <spinner />
              </div>
              <v-chart v-else :option="echartData" :autoresize="true"></v-chart>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      echartData: {},
      isLoading: false,
    };
  },
  methods: {
    fetchChartData() {
      this.isLoading = true;
      axios
        .get("/admin/reports/dashboard")
        .then((res) => {
          const responseData = res.data.data;

          this.echartData = {
            legend: {
              borderRadius: 0,
              orient: "horizontal",
              x: "right",
              data: ["Reservations"],
            },
            grid: {
              left: "8px",
              right: "8px",
              bottom: "0",
              containLabel: true,
            },
            tooltip: {
              show: true,

              backgroundColor: "rgba(0, 0, 0, .8)",
            },
            xAxis: [
              {
                type: "category",
                data: responseData.reservations.original.days,
                axisTick: {
                  alignWithLabel: true,
                },
                splitLine: {
                  show: false,
                },
                axisLabel: {
                  color: "#c2c6dc",
                  interval: 0,
                  rotate: 30,
                },
                axisLine: {
                  show: true,
                  color: "#c2c6dc",

                  lineStyle: {
                    color: "#c2c6dc",
                  },
                },
              },
            ],
            yAxis: [
              {
                type: "value",

                axisLabel: {
                  color: "#c2c6dc",
                  // formatter: "${value}"
                },
                axisLine: {
                  show: false,
                  color: "#c2c6dc",

                  lineStyle: {
                    color: "#c2c6dc",
                  },
                },
                min: 0,
                splitLine: {
                  show: true,
                  interval: "auto",
                },
                ticks: {
                  userCallback(label, index, labels) {
                    // only show if whole number
                    if (Math.floor(label) === label) {
                      return label;
                    }
                  },
                },
              },
            ],
            series: [
              {
                name: "Reservations",
                data: responseData.reservations.original.data,
                label: { show: false, color: "#8B5CF6" },
                type: "bar",
                color: "#A78BFA",
                smooth: true,
                itemStyle: {
                  emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowOffsetY: -2,
                    shadowColor: "rgba(0, 0, 0, 0.3)",
                  },
                },
              },
            ],
          };
          this.isLoading = false;
        })
        .catch((res) => {
          console.log(res);
        });
    },
  },
  async mounted() {
    await this.fetchChartData();
  },
};
</script>

<style scoped>
.chart-wrapper,
.echarts {
  height: 400px;
}
</style>
